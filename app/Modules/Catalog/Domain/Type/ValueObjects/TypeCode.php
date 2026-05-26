<?php

namespace App\Modules\Catalog\Domain\Type\ValueObjects;

use App\Modules\Shared\Application\Markers\CodeVO;
use App\Modules\Shared\Domain\Exceptions\DomainValidationException;

class TypeCode implements CodeVO
{
    public readonly string $value;

    public function __construct(
        int $value
    ) {
        $raw = (string) $value;
        if (strlen($raw) > 3) throw new DomainValidationException("Kode tidak lebih dari 4 digit angka");

        $formatted = str_pad((string) $raw, 4, '0', STR_PAD_LEFT);
        $this->value = $formatted;
    }
}