<?php

namespace Tests\Unit\UseCases;

use App\Modules\Catalog\Application\Commands\CreateProductCommand;
use App\Modules\Catalog\Application\UseCases\CreateProduct;
use App\Modules\Catalog\Domain\Product\Contracts\ProductCommandContract;
use App\Modules\Catalog\Domain\Product\Entities\ProductEntity;
use App\Modules\Catalog\Domain\Product\ValueObjects\ProductCode;
use App\Modules\Catalog\Domain\Project\Contracts\ProjectCommandContract;
use App\Modules\Shared\Domain\Exceptions\DomainNotFoundException;
use App\Modules\Shared\Domain\ValueObjects\NameVO;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

#[Group('product')]
#[Group('usecase')]
class CreateProductTest extends TestCase
{
    private CreateProduct $useCase;

    /**
     * @var ProductCommandContract&MockObject
     */
    private ProductCommandContract $product;

    /**
     * @var ProjectCommandContract&MockObject
     */
    private ProjectCommandContract $project;

    protected function setUp(): void
    {
        parent::setUp();

        $this->product = $this->createMock(ProductCommandContract::class);
        $this->project = $this->createMock(ProjectCommandContract::class);

        $this->useCase = new CreateProduct(
            $this->project,
            $this->product
        );
    }

    public function test_create_return_response_fail_with_invalid_project_id()
    {
        $this->project->method('exists')
            ->with(999)
            ->willReturn(false);

        $res = $this->useCase->handle(new CreateProductCommand(
            999,
            'test',
            '001'
        ));

        $this->assertEquals('Project tidak ditemukan', $res->message);
        $this->assertEquals(false, $res->success);
    }

    public function test_create_return_response_fail_with_duplicate_product()
    {
        $e = ProductEntity::create(999, new NameVO('test'), new ProductCode('2'));

        $this->project->method('exists')
            ->with(999)
            ->willReturn(true);

        $this->product->method('isDuplicate')
            ->with($e)
            ->willReturn(true);

        $res = $this->useCase->handle(new CreateProductCommand(
            999,
            'test',
            '2'
        ));

        $this->assertEquals(false, $res->success);
        $this->assertEquals(
            "Produk 'test' dengan code '2' sudah tersedia pada projek ini",
            $res->message
        );
    }

    public function test_create_with_null_code_and_return_response_ok()
    {
        $e = ProductEntity::create(
                999,
                new NameVO('test'),
                new ProductCode('2')
            );

        $this->project->method('exists')
            ->with(999)
            ->willReturn(true);

        $this->product->method('isDuplicate')
            ->with($e)
            ->willReturn(false);

        $this->product->method('findLastCode')
            ->with(999)
            ->willReturn(new ProductCode('1'));

        $this->product->method('save')
            ->with($e);

        $res = $this->useCase->handle(new CreateProductCommand(
            999,
            'test',
            null
        ));

        $this->assertEquals(true, $res->success);
        $this->assertEquals('Produk berhasil ditambahkan', $res->message);
    }
}
