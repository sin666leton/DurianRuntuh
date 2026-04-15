<?php

namespace App\Modules\Catalog\Application\DTOs;

class ProductSimpleDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $code
    ) {}
}