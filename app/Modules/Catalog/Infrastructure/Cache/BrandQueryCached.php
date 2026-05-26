<?php

namespace App\Modules\Catalog\Infrastructure\Cache;

use App\Modules\Catalog\Domain\Brand\Contracts\BrandQueryContract;
use App\Modules\Catalog\Infrastructure\Repositories\Queries\BrandQueryRepository;
use Illuminate\Support\Facades\Cache;

class BrandQueryCached implements BrandQueryContract
{
    public function __construct(
        private BrandQueryRepository $repo
    ) {}

    public function getAllBrand(int $size = 10): array
    {
        return Cache::remember('brand:all', 900, fn() => $this->repo->getAllBrand($size));
    }

    public function searchByName(string $name): array
    {
        return $this->repo->searchByName($name);
    }
}