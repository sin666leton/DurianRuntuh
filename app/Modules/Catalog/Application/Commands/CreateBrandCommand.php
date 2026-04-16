<?php

namespace App\Modules\Catalog\Application\Commands;

class CreateBrandCommand
{
    public function __construct(
        public string $name,
        public ?int $code = null
    ) {}
}