<?php

namespace Tests\Support;

use App\Modules\Shared\Domain\Exceptions\DomainValidationException;

trait CodeVORule
{
    protected function assertInvalidWithString(string $className, string $value, int $maxLength)
    {
        $this->expectException(DomainValidationException::class);
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage("Kode harus $maxLength digit angka");

        new $className($value);
    }

    protected function assertInvalidFormat(string $className, string $value, int $maxLength)
    {
        $this->expectException(DomainValidationException::class);
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage("Kode harus $maxLength digit angka");

        new $className($value);
    }
}