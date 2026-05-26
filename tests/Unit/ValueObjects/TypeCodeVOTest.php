<?php

namespace Tests\Unit\ValueObjects;

use App\Modules\Catalog\Domain\Type\ValueObjects\TypeCode;
use App\Modules\Shared\Domain\Exceptions\DomainValidationException;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[Group('catalog')]
#[Group('type')]
#[Group('vo')]
class TypeCodeVOTest extends TestCase
{
    public function test_code_throw_DomainValidationException_with_invalid_format()
    {
        $this->expectException(DomainValidationException::class);
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage("Kode tidak lebih dari 4 digit angka");

        new TypeCode(1000);
    }

    public function test_code_return_value()
    {
        $code = new TypeCode(1);

        $this->assertEquals('0001', $code->value);
    }
}
