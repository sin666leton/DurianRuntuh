<?php

namespace Tests\Unit\UseCases;

use App\Modules\Catalog\Application\Commands\CreateProductCommand;
use App\Modules\Catalog\Application\DTOs\ProductSimpleDTO;
use App\Modules\Catalog\Application\UseCases\CreateProduct;
use App\Modules\Catalog\Domain\Product\Contracts\ProductCommandContract;
use App\Modules\Catalog\Domain\Product\Entities\ProductEntity;
use App\Modules\Catalog\Domain\Product\ValueObjects\ProductCode;
use App\Modules\Shared\Domain\Exceptions\DomainConflictException;
use App\Modules\Shared\Domain\Exceptions\DomainNotFoundException;
use App\Modules\Shared\Domain\ValueObjects\NameVO;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

#[Group('catalog')]
#[Group('product')]
#[Group('usecase')]
class CreateProductTest extends TestCase
{
    private CreateProduct $useCase;

    /**
     * @var ProductCommandContract&MockObject
     */
    private ProductCommandContract $product;

    protected function setUp(): void
    {
        parent::setUp();

        $this->product = $this->createMock(ProductCommandContract::class);

        $this->useCase = new CreateProduct(
            $this->product
        );
    }

    public function test_create_product_throw_DomainConflictException_when_duplicated()
    {
        $this->expectException(DomainConflictException::class);
        $this->expectExceptionMessage("Produk 'product' dengan code '1' sudah tersedia");
        $this->expectExceptionCode(409);
        
        $this->product
            ->expects($this->once())
            ->method('isDuplicate')
            ->with($this->callback(function ($entity) {
                return $entity instanceof ProductEntity
                && $entity->getCode() === '1'
                && $entity->getName() === 'product';
            }))
            ->willReturn(true);

        $this->useCase->handle(new CreateProductCommand(
            'product',
            '1'
        ));
    }

    public function test_create_product_should_return_ProductSimpleDTO_with_null_code()
    {
        $this->product
            ->expects($this->once())
            ->method('findLastCode')
            ->willReturn(new ProductCode('1'));

        $this->product
            ->expects($this->once())
            ->method('isDuplicate')
            ->with($this->callback(function ($entity) {
                return $entity instanceof ProductEntity
                && $entity->getCode() === '2'
                && $entity->getName() === 'product';
            }))
            ->willReturn(false);

        $this->product
            ->expects($this->once())
            ->method('save')
            ->with($this->callback(function ($entity) {
                return $entity instanceof ProductEntity
                && $entity->getCode() === '2'
                && $entity->getName() === 'product';
            }));

        $res = $this->useCase->handle(new CreateProductCommand(
            'product'
        ));

        $this->assertInstanceOf(ProductSimpleDTO::class, $res);
        $this->assertEquals('2', $res->code);
        $this->assertEquals('product', $res->name);
    }

    public function test_create_product_should_return_ProductSimpleDTO_with_code()
    {
        $this->product
            ->expects($this->never())
            ->method('findLastCode');

        $this->product
            ->expects($this->once())
            ->method('isDuplicate')
            ->with($this->callback(function ($entity) {
                return $entity instanceof ProductEntity
                && $entity->getCode() === '1'
                && $entity->getName() === 'product';
            }))
            ->willReturn(false);

        $this->product
            ->expects($this->once())
            ->method('save')
            ->with($this->callback(function ($entity) {
                return $entity instanceof ProductEntity
                && $entity->getCode() === '1'
                && $entity->getName() === 'product';
            }));

        $res = $this->useCase->handle(new CreateProductCommand(
            'product',
            '1'
        ));

        $this->assertInstanceOf(ProductSimpleDTO::class, $res);
        $this->assertEquals('1', $res->code);
        $this->assertEquals('product', $res->name);
    }
}
