<?php

namespace App\Modules\Catalog\Domain\Item\ValueObjects;

use App\Modules\Catalog\Domain\Brand\ValueObjects\BrandCode;
use App\Modules\Catalog\Domain\Product\ValueObjects\ProductCode;
use App\Modules\Catalog\Domain\Project\ValueObjects\ProjectCode;
use App\Modules\Catalog\Domain\Type\ValueObjects\TypeCode;
use App\Modules\Catalog\Domain\TypeItem\ValueObjects\TypeItemCode;
use App\Modules\Shared\Domain\Exceptions\DomainValidationException;

class ItemCode
{
    public readonly string $value;

    public function __construct(
        BrandCode $brand,
        TypeItemCode $typeItem,
        TypeCode $type
    )
    {
        $this->value = "1.1.{$brand->value}.{$typeItem->value}.{$type->value}";
    }

}