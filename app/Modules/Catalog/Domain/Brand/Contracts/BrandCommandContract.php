<?php

namespace App\Modules\Catalog\Domain\Brand\Contracts;

use App\Modules\Catalog\Domain\Brand\Entities\BrandEntity;
use App\Modules\Catalog\Domain\Brand\ValueObjects\BrandCode;

interface BrandCommandContract
{
    /**
     * Cari Merk berdasarkan ID
     * 
     * @param int $id
     * @return BrandEntity|null
     */
    public function find(int $id): BrandEntity|null;

    /**
     * Ambil kode terakhir merk
     * 
     * @return BrandCode|null
     */
    public function findLastCode(): BrandCode|null;

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