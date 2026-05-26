<?php

namespace App\Modules\Catalog\Application\UseCases;

use App\Modules\Catalog\Application\DTOs\SimpleBrandDTO;
use App\Modules\Catalog\Domain\Brand\Contracts\BrandQueryContract;

class GetAllBrand
{
    public function __construct(
        private BrandQueryContract $query
    ) {}

    /**
     * @return SimpleBrandDTO[]
     */
    public function handle(): array
    {
        $brands = $this->query->getAllBrand(10);
        $dtos = array_map(fn($brand) => new SimpleBrandDTO($brand->id, $brand->name, $brand->code), $brands);

        return $dtos;
    }
}