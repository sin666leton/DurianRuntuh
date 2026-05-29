<?php

namespace App\Modules\Catalog\Domain\TypeItem\Contracts;

use App\Modules\Catalog\Application\DTOs\SimpleTypeItemDTO;
use App\Modules\Catalog\Application\DTOs\TypeItemDTO;
use Illuminate\Pagination\LengthAwarePaginator;

interface TypeItemQueryContract
{
    /**
     * @return SimpleTypeItemDTO[]
     */
    public function search(string $search = ''): array;

    /** 
     * Paginasi Jenis barang dengan fitur pencarian
     * 
     * @return LengthAwarePaginator<TypeItemDTO>
    */
    public function paginateWithSearch(int $size, ?string $search = null): LengthAwarePaginator;
}