<?php

namespace App\Modules\Catalog\Infrastructure\Decorators;

use App\Modules\Catalog\Application\Commands\CreateCatalogHistoryCreateCommand;
use App\Modules\Catalog\Application\UseCases\CreateCatalogHistory;
use App\Modules\Catalog\Domain\Brand\Contracts\BrandCommandContract;
use App\Modules\Catalog\Domain\CatalogHistory\Contracts\CatalogHistoryCommandContract;
use App\Modules\Catalog\Domain\CatalogHistory\Entities\CatalogHistoryEntity;
use App\Modules\Catalog\Domain\CatalogHistory\Enums\CatalogActionEnum;
use App\Modules\Catalog\Domain\CatalogHistory\ValueObjects\ChangesVO;
use App\Modules\Catalog\Infrastructure\Repositories\Commands\BrandCommandRepository;

class BrandCommandHistory implements BrandCommandContract
{
    public function __construct(
        private BrandCommandRepository $repo,
        private CatalogHistoryCommandContract $history
    ) {}

    public function find(int $id): \App\Modules\Catalog\Domain\Brand\Entities\BrandEntity|null
    {
        return $this->repo->find($id);
    }

    public function findLastCode(): \App\Modules\Catalog\Domain\Brand\ValueObjects\BrandCode|null
    {
        return $this->repo->findLastCode();
    }

    public function save(\App\Modules\Catalog\Domain\Brand\Entities\BrandEntity $e): void
    {
        $this->repo->save($e);

        $entity = new CatalogHistoryEntity(
            $e->getUserId(),
            'Master Merk',
            CatalogActionEnum::CREATE,
            new ChangesVO([
                'name' => $e->getName(),
                'code' => $e->getCode()->value
            ]),
            $e->getId()
        );

        $this->history->save($entity);
    }

    public function isDuplicate(\App\Modules\Catalog\Domain\Brand\Entities\BrandEntity $e): bool
    {
        return $this->repo->isDuplicate($e);
    }
}