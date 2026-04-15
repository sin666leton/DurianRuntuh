<?php

namespace App\Modules\Catalog\Domain\Product\Contracts;

use App\Modules\Catalog\Domain\Product\Entities\ProductEntity;
use App\Modules\Catalog\Domain\Product\ValueObjects\ProductCode;

interface ProductCommandContract
{
    /**
     * Cek apakah produk duplikat
     * 
     * @return bool
     */
    public function isDuplicate(ProductEntity $e): bool;

    /**
     * Ambil kode terakhir
     * 
     * @return ProductCode
     */
    public function findLastCode(): ProductCode;

    /**
     * Tambah produk
     * 
     * @return void
     */
    public function save(ProductEntity $e): void;
}