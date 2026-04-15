<?php

namespace App\Modules\Catalog\Domain\Product\ValueObjects;

use App\Modules\Shared\Domain\ValueObjects\BaseCodeVO;

final class ProductCode extends BaseCodeVO
{
    public function __construct(
        public readonly string $value
    ) {
        $this->validate($value, 1);
    }
}