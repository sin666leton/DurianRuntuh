<?php

namespace App\Modules\Catalog\Application\Commands;

class CreateTypeItemCommand
{
    public function __construct(
        public string $name,
        public ?int $code = null
    ) {}
}