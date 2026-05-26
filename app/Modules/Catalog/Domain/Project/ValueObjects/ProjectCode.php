<?php

namespace App\Modules\Catalog\Domain\Project\ValueObjects;

use App\Modules\Shared\Domain\Exceptions\DomainValidationException;

class ProjectCode
{
    public readonly string $value;

    public function __construct(int $value)
    {
        $raw = (string) $value;
        if (strlen($raw) > 1) throw new DomainValidationException("Kode tidak lebih dari 1 digit angka");

        $formatted = str_pad((string) $raw, 1, '0', STR_PAD_LEFT);
        $this->value = $formatted;
    }
}