<?php

namespace App\Modules\Catalog\Application\DTOs;

readonly class TypeDTO
{
    public function __construct(
        public int $id,
        public readonly int $userId,

        /**
         * Username pengguna
         */
        public readonly string $username,

        /**
         * Nama Pengguna
         */
        public readonly string $userName,

        public string $brandName,
        public string $brandCode,
        public string $typeItemName,
        public string $typeItemCode,
        public string $itemDescription,
        public string $itemCode,
        public string $name,
        public string $code,
    ) {}
}