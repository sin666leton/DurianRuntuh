<?php

namespace App\Modules\Catalog\Application\DTOs;

readonly class SimpleBrandDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $code
    ) {}

    public function toPresentation(): array
    {
        return [
            'brand_id' => $this->id,
            'brand_name' => $this->name.' - '.$this->code
        ];
    }
}