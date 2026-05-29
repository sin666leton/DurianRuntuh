<?php

namespace App\Modules\Catalog\Application\UseCases;

use App\Modules\Catalog\Domain\TypeItem\Contracts\TypeItemCommandContract;
use App\Modules\Catalog\Domain\TypeItem\ValueObjects\TypeItemCode;

class GetTypeItemLastCode
{
    public function __construct(
        private TypeItemCommandContract $repository
    ) {}

    public function handle(): TypeItemCode|null
    {
        return $this->repository->findLastCode();
    }
}