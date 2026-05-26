<?php

namespace App\Modules\Catalog\Infrastructure\Repositories\Queries;

use App\Modules\Catalog\Domain\Product\Contracts\ProductQueryContract;

class ProductQueryRepository implements ProductQueryContract
{
    public function getAllProduct(int $size = 10): array
    {
        
    }
}