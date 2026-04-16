<?php

namespace Tests\Unit\ValueObjects;

use App\Modules\Catalog\Domain\Brand\ValueObjects\BrandCode;
use App\Modules\Shared\Domain\Exceptions\DomainValidationException;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use Tests\Support\CodeVORule;

#[Group('catalog')]
#[Group('vo')]
#[Group('brand')]
class BrandCodeVOTest extends TestCase
{
    use CodeVORule;

    public function test_code_throw_DomainValidationException_with_invalid_format()
    {
        $this->expectException(DomainValidationException::class);
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage("Kode tidak lebih dari 3 digit angka");

        new BrandCode(1000);
    }

    public function test_code_return_value()
    {
        $code = new BrandCode(1);

        $this->assertEquals('001', $code->value);
    }
}
