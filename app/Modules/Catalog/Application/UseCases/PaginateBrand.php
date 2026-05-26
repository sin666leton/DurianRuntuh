<?php

namespace App\Modules\Catalog\Application\UseCases;

use App\Modules\Catalog\Domain\Brand\Contracts\BrandQueryContract;
use Illuminate\Pagination\LengthAwarePaginator;

class PaginateBrand
{
    public function __construct(
        private BrandQueryContract $repository
    ) {}

    public function handle(int $size=10, ?string $search = null): LengthAwarePaginator
    {
        return $this->repository->paginateWithSearch($size, $search);
    }
}