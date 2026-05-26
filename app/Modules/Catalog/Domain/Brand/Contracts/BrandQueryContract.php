<?php

namespace App\Modules\Catalog\Domain\Brand\Contracts;

use App\Modules\Catalog\Application\DTOs\PaginatedBrandDTO;
use Illuminate\Pagination\LengthAwarePaginator;


interface BrandQueryContract
{
    public function paginateWithSearch(int $size, ?string $search = null): LengthAwarePaginator; 
}