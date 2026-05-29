<?php

namespace App\Modules\Catalog\Application\UseCases;

use App\Modules\Catalog\Application\DTOs\TypeItemDTO;
use App\Modules\Catalog\Domain\TypeItem\Contracts\TypeItemQueryContract;
use Illuminate\Pagination\LengthAwarePaginator;

class PaginateTypeItem
{
    public function __construct(
        private TypeItemQueryContract $repository
    ){}

    /**
     * @return LengthAwarePaginator<TypeItemDTO>
     */
    public function handle(int $size = 10, ?string $search = ''): LengthAwarePaginator
    {
        return $this->repository->paginateWithSearch($size, $search);
    }
}