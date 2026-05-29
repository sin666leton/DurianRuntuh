<?php

namespace App\Modules\Catalog\Domain\Brand\Contracts;

use App\Modules\Catalog\Application\DTOs\PaginatedBrandDTO;
use App\Modules\Catalog\Application\DTOs\SimpleBrandDTO;
use Illuminate\Pagination\LengthAwarePaginator;


interface BrandQueryContract
{
    /**
     * @param string $search
     * @return array<SimpleBrandDTO>
     */
    public function search(string $search = ''): array;

    public function paginateWithSearch(int $size, ?string $search = null): LengthAwarePaginator; 
}