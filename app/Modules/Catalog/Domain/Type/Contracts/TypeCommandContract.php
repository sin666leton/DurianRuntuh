<?php

namespace App\Modules\Catalog\Domain\Type\Contracts;

use App\Modules\Catalog\Domain\Type\Entities\TypeEntity;
use App\Modules\Catalog\Domain\Type\ValueObjects\TypeCode;

interface TypeCommandContract
{
    /**
     * Cek apakah tipe duplikat
     * 
     * @param TypeEntity $e
     * @return bool
     */
    public function isDuplicate(TypeEntity $e): bool;

    /**
     * Ambil kode tipe terakhir
     * 
     * @param int $brandId
     * @param int $typeItemId
     * @return TypeCode|null
     */
    public function findLastCode(int $brandId, int $typeItemId): TypeCode|null;

    /**
     * Simpan entity ke database
     * 
     * @param TypeEntity $e
     * @return void
     */
    public function save(TypeEntity $e): void;
}