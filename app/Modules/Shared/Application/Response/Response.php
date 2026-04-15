<?php

namespace App\Modules\Shared\Application\Response;

use App\Modules\Shared\Application\Markers\Data;

class Response
{
    public function __construct(
        public readonly bool $success,
        public readonly null|Data|array $data,
        public readonly ?string $message
    ) {}

    public static function ok(?string $message = null, array|Data $data = []): static
    {
        return new self(
            true,
            $data,
            $message
        );
    }

    public static function fail(string $message, array $data = []): static
    {
        return new self(
            false,
            $data,
            $message
        );
    }
}