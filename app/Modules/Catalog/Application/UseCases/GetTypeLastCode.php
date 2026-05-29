<?php

namespace App\Modules\Catalog\Application\UseCases;

use App\Modules\Catalog\Domain\Type\Contracts\TypeCommandContract;

class GetTypeLastCode
{
    public function __construct(
        private TypeCommandContract $repository
    ) {}

    public function handle(int $brandId, int $typeItemId)
    {
        return $this->repository->findLastCode($brandId, $typeItemId);
    }
}