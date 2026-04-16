<?php

namespace Tests\Unit\ValueObjects;

use App\Modules\Catalog\Domain\TypeItem\ValueObjects\TypeItemCode;
use App\Modules\Shared\Domain\Exceptions\DomainValidationException;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[Group('catalog')]
#[Group('typeitem')]
#[Group('vo')]
class TypeItemCodeVOTest extends TestCase
{
    public function test_code_throw_DomainValidationException_with_invalid_format()
    {
        $this->expectException(DomainValidationException::class);
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage("Kode tidak lebih dari 3 digit angka");

        new TypeItemCode(1000);
    }

    public function test_code_return_value()
    {
        $code = new TypeItemCode(1);

        $this->assertEquals('001', $code->value);
    }
}
