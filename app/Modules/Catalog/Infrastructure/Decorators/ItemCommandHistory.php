<?php

namespace App\Modules\Catalog\Infrastructure\Decorators;

use App\Modules\Catalog\Domain\CatalogHistory\Contracts\CatalogHistoryCommandContract;
use App\Modules\Catalog\Domain\CatalogHistory\Entities\CatalogHistoryEntity;
use App\Modules\Catalog\Domain\CatalogHistory\Enums\CatalogActionEnum;
use App\Modules\Catalog\Domain\CatalogHistory\ValueObjects\ChangesVO;
use App\Modules\Catalog\Domain\Item\Contracts\ItemCommandContract;
use App\Modules\Catalog\Infrastructure\Repositories\Commands\ItemCommandRepository;

class ItemCommandHistory implements ItemCommandContract
{
    public function __construct(
        private ItemCommandRepository $repo,
        private CatalogHistoryCommandContract $history
    ) {}

    public function save(\App\Modules\Catalog\Domain\Item\Entities\ItemEntity $e): void
    {
        $this->repo->save($e);

        $catalogEntity = new CatalogHistoryEntity(
            auth()->user()->id,
            'Tipe',
            CatalogActionEnum::CREATE,
            new ChangesVO([
                'name' => $e->getDescription()->value,
                'code' => $e->getCode()->value
            ]),
            $e->getId()
        );

        $this->history->save($catalogEntity);
    }
}