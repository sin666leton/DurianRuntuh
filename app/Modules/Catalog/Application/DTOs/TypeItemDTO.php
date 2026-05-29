<?php

namespace App\Modules\Catalog\Application\DTOs;

readonly class TypeItemDTO
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
         * Nama Jenis baran
         */
        public readonly string $name,

        public readonly string $code
    ) {}
}