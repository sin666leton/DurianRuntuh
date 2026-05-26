<?php

namespace App\Modules\Catalog\Domain\Stock\ValueObjects;

use App\Modules\Catalog\Domain\Brand\ValueObjects\BrandCode;
use App\Modules\Catalog\Domain\Product\ValueObjects\ProductCode;
use App\Modules\Catalog\Domain\Project\ValueObjects\ProjectCode;
use App\Modules\Catalog\Domain\Type\ValueObjects\TypeCode;
use App\Modules\Catalog\Domain\TypeItem\ValueObjects\TypeItemCode;
use App\Modules\Shared\Domain\Exceptions\DomainValidationException;

class StockCode
{
    public readonly string $value;

    public function __construct(
        ProjectCode $project,
        ProductCode $product,
        BrandCode $brand,
        TypeItemCode $typeItem,
        TypeCode $type
    )
    {
        $this->value = "{$project->value}.{$product->value}.{$brand->value}.{$typeItem->value}.{$type->value}";
    }

}