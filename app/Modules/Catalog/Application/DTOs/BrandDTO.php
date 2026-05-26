<?php

namespace App\Modules\Catalog\Application\DTOs;

readonly class BrandDTO
{
    public function __construct(
        public readonly int $userId,

        /**
         * Username pengguna
         */
        public readonly string $username,

        /**
         * Nama Pengguna
         */
        public readonly string $userName,

        public readonly int $id,

        /**
         * Nama merk
         */
        public readonly string $name,

        public readonly string $code
    ) {}
}