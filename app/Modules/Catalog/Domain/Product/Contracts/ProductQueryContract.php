<?php

namespace App\Modules\Catalog\Domain\Product\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface ProductQueryContract
{
    // Cari produk berdasarkan nama dan id projek
    public function searchByNameAndProjectId(int $projectId, string $name): Collection;
}