<?php

namespace App\Modules\Catalog\Domain\TypeItem\Contracts;

use App\Modules\Catalog\Domain\TypeItem\Entities\TypeItemEntity;
use App\Modules\Catalog\Domain\TypeItem\ValueObjects\TypeItemCode;

interface TypeItemCommandContract
{
    /**
     * Ambil kode terakhir jenis barang
     * 
     * @return TypeItemCode
     */
    public function findLastCode(): TypeItemCode;

    /**
     * Cek apakah jenis barang duplikat
     * 
     * @param TypeItemEntity $e
     * @return bool
     */
    public function isDuplicate(TypeItemEntity $e): bool;

    /**
     * Tambah Jenis barang
     * 
     * @param TypeItemEntity $e
     * @return void
     */
    public function save(TypeItemEntity $e): void;
}