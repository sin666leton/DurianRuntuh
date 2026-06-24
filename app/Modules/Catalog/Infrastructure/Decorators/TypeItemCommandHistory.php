<?php

namespace App\Modules\Catalog\Infrastructure\Decorators;

use App\Modules\Catalog\Domain\CatalogHistory\Contracts\CatalogHistoryCommandContract;
use App\Modules\Catalog\Domain\CatalogHistory\Entities\CatalogHistoryEntity;
use App\Modules\Catalog\Domain\CatalogHistory\Enums\CatalogActionEnum;
use App\Modules\Catalog\Domain\CatalogHistory\ValueObjects\ChangesVO;
use App\Modules\Catalog\Domain\TypeItem\Contracts\TypeItemCommandContract;
use App\Modules\Catalog\Infrastructure\Repositories\Commands\TypeItemCommandRepository;

class TypeItemCommandHistory implements TypeItemCommandContract
{
    public function __construct(
        private TypeItemCommandRepository $repo,
        private CatalogHistoryCommandContract $history
    )
    {}

    public function find(int $id): \App\Modules\Catalog\Domain\TypeItem\Entities\TypeItemEntity|null
    {
        return $this->repo->find($id);
    }

    public function findLastCode(): \App\Modules\Catalog\Domain\TypeItem\ValueObjects\TypeItemCode|null
    {
        return $this->repo->findLastCode();
    }

    public function isDuplicate(\App\Modules\Catalog\Domain\TypeItem\Entities\TypeItemEntity $e): bool
    {
        return $this->repo->isDuplicate($e);
    }

    public function save(\App\Modules\Catalog\Domain\TypeItem\Entities\TypeItemEntity $e): void
    {
        $this->repo->save($e);

        $entity = new CatalogHistoryEntity(
            $e->getUserId(),
            'Master Jenis Barang',
            CatalogActionEnum::CREATE,
            new ChangesVO([
                'name' => $e->getName(),
                'code' => $e->getCode()->value
            ]),
            $e->getId()
        );

        $this->history->save($entity);
    }
}