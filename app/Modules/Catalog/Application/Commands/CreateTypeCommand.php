<?php

namespace App\Modules\Catalog\Application\Commands;

class CreateTypeCommand
{
    public function __construct(
        public int $userId,
        public int $brandId,
        public int $typeItemId,
        public string $name,
        public ?int $code = null
    ) {}
}