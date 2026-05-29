<?php

namespace App\Modules\Catalog\Application\UseCases;

use App\Modules\Catalog\Domain\Type\Contracts\TypeQueryContract;

class PaginateType
{
    public function __construct(
        private TypeQueryContract $repository
    ) {}

    public function handle(int $size = 10, string $search = '')
    {
        return $this->repository->paginateWithSearch($size, $search);
    }
}