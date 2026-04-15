<?php

namespace App\Modules\Catalog\Application\DTOs;

class SimpleListProjectDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name
    ) {}
}