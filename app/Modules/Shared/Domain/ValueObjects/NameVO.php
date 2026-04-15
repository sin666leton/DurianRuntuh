<?php

namespace App\Modules\Shared\Domain\ValueObjects;

use App\Modules\Shared\Domain\Exceptions\DomainValidationException;

final class NameVO
{
    public function __construct(
        public readonly string $value
    ) {
        $value = trim($value);

        if (strlen($value) < 1) throw new DomainValidationException("Nama tidak boleh kosong");
        if (strlen($value) > 255) throw new DomainValidationException("Nama tidak lebih dari 255 karakter");
    }
}