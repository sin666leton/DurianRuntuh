<?php

namespace App\Modules\Catalog\Infrastructure\Repositories\Commands;

use App\Models\CatalogHistory;
use App\Modules\Catalog\Domain\CatalogHistory\Contracts\CatalogHistoryCommandContract;

class CatalogHistoryCommandRepository implements CatalogHistoryCommandContract
{
    public function save(\App\Modules\Catalog\Domain\CatalogHistory\Entities\CatalogHistoryEntity $e): void
    {
        $result = CatalogHistory::create([
            'user_id' => $e->getUserId(),
            'action' => $e->getAction()->value,
            'model_id' => $e->getModelId(),
            'model_type' => $e->getModelType(),
            'changes' => $e->getChanges()->value
        ]);

        $e->setId($result->id);
    }
}