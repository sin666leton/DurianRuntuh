<?php

namespace App\Modules\Catalog\Application\UseCases;

use App\Modules\Catalog\Domain\TypeItem\Contracts\TypeItemQueryContract;

class SearchTypeItem
{
    public function __construct(
        private TypeItemQueryContract $repository
    ) {}
    
    public function handle(string $search = '')
    {
        return $this->repository->search($search);
    }
}