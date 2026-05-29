<?php

namespace App\Modules\Catalog\Domain\Item\ValueObjects;

class ItemDescriptionVO
{
    public readonly string $value;

    public function __construct(
        string $typeItemName,
        string $typeName,
        string $brandName
    )
    {
        $this->value = "{$typeItemName} {$typeName}, {$brandName}";
    }
}