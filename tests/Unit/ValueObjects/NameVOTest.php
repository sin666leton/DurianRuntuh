<?php

namespace Tests\Unit\ValueObjects;

use App\Modules\Shared\Domain\Exceptions\DomainValidationException;
use App\Modules\Shared\Domain\ValueObjects\NameVO;
use PHPUnit\Framework\TestCase;

class NameVOTest extends TestCase
{
    public function test_name_vo_throw_DomainValidationException_with_empty_string()
    {
        $this->expectException(DomainValidationException::class);
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage('Nama tidak boleh kosong');

        new NameVO('');
    }

    public function test_name_vo_return_value()
    {
        $vo = new NameVO('test');

        $this->assertEquals('test', $vo->value);
    }
}
