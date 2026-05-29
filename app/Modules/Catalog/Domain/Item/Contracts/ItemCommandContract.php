<?php

namespace App\Modules\Catalog\Domain\Item\Contracts;

use App\Modules\Catalog\Domain\Item\Entities\ItemEntity;

interface ItemCommandContract
{
    /**
     * Simpan Stok ke database
     * 
     * @param ItemEntity $e
     * @return void
     */
    public function save(ItemEntity $e): void;
}