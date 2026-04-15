<?php

namespace Tests\Unit\UseCases;

use App\Modules\Catalog\Application\Commands\CreateProductCommand;
use App\Modules\Catalog\Application\UseCases\CreateProduct;
use App\Modules\Catalog\Domain\Product\Contracts\ProductCommandContract;
use App\Modules\Catalog\Domain\Product\Entities\ProductEntity;
use App\Modules\Catalog\Domain\Product\ValueObjects\ProductCode;
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

    protected function setUp(): void
    {
        parent::setUp();

        $this->product = $this->createMock(ProductCommandContract::class);

        $this->useCase = new CreateProduct(
            $this->product
        );
    }

}
