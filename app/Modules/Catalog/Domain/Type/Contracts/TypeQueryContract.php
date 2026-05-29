<?php

namespace App\Modules\Catalog\Domain\Type\Contracts;

use App\Modules\Catalog\Application\DTOs\TypeDTO;
use Illuminate\Pagination\LengthAwarePaginator;

interface TypeQueryContract
{
    /**
     * @return LengthAwarePaginator<TypeDTO>
     */
    public function paginateWithSearch(int $size, string $search = ''): LengthAwarePaginator;
}