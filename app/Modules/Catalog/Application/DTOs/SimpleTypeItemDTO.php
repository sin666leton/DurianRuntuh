<?php

namespace App\Modules\Catalog\Application\DTOs;

class SimpleTypeItemDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $code
    ) {}

    public function toPresentation(): array
    {
        return [
            'type_item_id' => $this->id,
            'type_item_name' => $this->name.' - '.$this->code
        ];
    }
}