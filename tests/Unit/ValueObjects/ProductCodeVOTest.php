<?php

namespace Tests\Unit\ValueObjects;

use App\Modules\Catalog\Domain\Product\ValueObjects\ProductCode;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use Tests\Support\CodeVORule;

#[Group('vo')]
#[Group('product')]
class ProductCodeVOTest extends TestCase
{
    use CodeVORule;

    public function test_code_throw_DomainValidationException_with_string()
    {
        $this->assertInvalidWithString(ProductCode::class, 'test', 1);
    }

    public function test_code_throw_DomainValidationException_with_invalid_format()
    {
        $this->assertInvalidFormat(ProductCode::class, '01', 1);
    }

    public function test_code_return_value()
    {
        $vo = new ProductCode('1');

        $this->assertEquals('1', $vo->value);
    }
}
