<?php

namespace App\Modules\Catalog\Application\Commands;

class CreateProductCommand
{
    public function __construct(
        public string $name,
        public ?string $code
    ) {}
}