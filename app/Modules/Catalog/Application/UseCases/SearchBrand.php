<?php

namespace App\Modules\Catalog\Application\UseCases;

use App\Modules\Catalog\Application\DTOs\SimpleBrandDTO;
use App\Modules\Catalog\Domain\Brand\Contracts\BrandQueryContract;

class SearchBrand
{
    public function __construct(
        private BrandQueryContract $query
    ) {}

    /**
     * @return SimpleBrandDTO[]
     */
    public function handle(string $search): array
    {
        return $this->query->search($search);
    }
}