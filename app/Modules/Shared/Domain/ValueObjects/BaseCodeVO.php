<?php

namespace App\Modules\Shared\Domain\ValueObjects;

use App\Modules\Shared\Domain\Exceptions\DomainValidationException;

abstract class BaseCodeVO
{
    public function validate(string $value, int $maxLength)
    {
        $pattern = '/^[0-9]{'.$maxLength.'}$/';

        if (!preg_match($pattern, $value)) throw new DomainValidationException("Kode harus $maxLength digit angka");
    }
}