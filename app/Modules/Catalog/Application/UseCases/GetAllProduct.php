<?php

namespace App\Modules\Catalog\Application\UseCases;

use App\Modules\Catalog\Application\DTOs\SimpleProductDTO;
use App\Modules\Catalog\Domain\Product\Contracts\ProductQueryContract;

class GetAllProduct
{
    public function __construct(
        private ProductQueryContract $query
    ) {}

    /**
     * @return SimpleProductDTO[]
     */
    public function handle(): array
    {
        $prodArray = $this->query->getAllProduct();
        $dtos = array_map(fn($product) => new SimpleProductDTO($product->id, $product->name, $product->code), $prodArray);

        return $dtos;
    }
}