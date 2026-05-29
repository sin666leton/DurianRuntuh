<?php

namespace App\Modules\Catalog\Infrastructure\Repositories\Commands;

use App\Models\Item;
use App\Modules\Catalog\Domain\Item\Contracts\ItemCommandContract;

class ItemCommandRepository implements ItemCommandContract
{
    public function save(\App\Modules\Catalog\Domain\Item\Entities\ItemEntity $e): void
    {
        $res = Item::create([
            'type_id' => $e->getTypeId(),
            'description' => $e->getDescription()->value,
            'code' => $e->getCode()->value
        ]);

        $e->setId($res->id);
    }
}