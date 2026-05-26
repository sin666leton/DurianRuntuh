<?php

namespace App\Modules\Catalog\Application\DTOs;

class SimpleTypeDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $code
    ) {}
}