<?php

namespace App\Modules\Catalog\Domain\Stock\Contracts;

use App\Modules\Catalog\Domain\Stock\Entities\StockEntity;

interface StockCommandContract
{
    /**
     * Simpan Stok ke database
     * 
     * @param StockEntity $e
     * @return void
     */
    public function save(StockEntity $e): void;
}