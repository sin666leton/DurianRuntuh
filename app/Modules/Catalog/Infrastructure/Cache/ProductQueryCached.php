<?php

namespace App\Modules\Catalog\Infrastructure\Cache;

use App\Modules\Catalog\Domain\Product\Contracts\ProductQueryContract;
use App\Modules\Catalog\Infrastructure\Repositories\Queries\ProductQueryRepository;
use Illuminate\Support\Facades\Cache;

class ProductQueryCached implements ProductQueryContract
{
    public function __construct(
        private ProductQueryRepository $repo
    ) {}

    public function getAllProduct(int $size = 10): array
    {
        return Cache::remember('product:all', 900, fn() => $this->repo->getAllProduct($size));
    }
}