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
     * @param string $name
     * @return SimpleBrandDTO[]
     */
    public function handle(string $name): array
    {
        $brands = $this->query->searchByName($name);
        $dtos = array_map(fn($brand) => new SimpleBrandDTO($brand->id, $brand->name, $brand->code), $brands);

        return $dtos;
    }
}