<?php

namespace App\Modules\Catalog\Domain\CatalogHistory\Contracts;

use App\Modules\Catalog\Domain\CatalogHistory\Entities\CatalogHistoryEntity;

interface CatalogHistoryCommandContract
{
    public function save(CatalogHistoryEntity $e): void;
}