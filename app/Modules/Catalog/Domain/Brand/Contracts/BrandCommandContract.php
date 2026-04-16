<?php

namespace App\Modules\Catalog\Domain\Brand\Contracts;

use App\Modules\Catalog\Domain\Brand\Entities\BrandEntity;
use App\Modules\Catalog\Domain\Brand\ValueObjects\BrandCode;

interface BrandCommandContract
{
    /**
     * Ambil kode terakhir merk
     * 
     * @return BrandCode
     */
    public function findLastCode(): BrandCode;

    /**
     * Cek apakah merk duplikat
     * 
     * @param BrandEntity $e
     * @return bool
     */
    public function isDuplicate(BrandEntity $e): bool;

    /**
     * Tambah Merk
     * 
     * @param BrandEntity $e
     * @return void
     */
    public function save(BrandEntity $e): void;
}