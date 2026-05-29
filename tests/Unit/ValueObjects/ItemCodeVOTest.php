<?php

namespace Tests\Unit\ValueObjects;

use App\Modules\Catalog\Domain\Brand\ValueObjects\BrandCode;
use App\Modules\Catalog\Domain\Item\ValueObjects\ItemCode;
use App\Modules\Catalog\Domain\Type\ValueObjects\TypeCode;
use App\Modules\Catalog\Domain\TypeItem\ValueObjects\TypeItemCode;
use App\Modules\Shared\Domain\Exceptions\DomainValidationException;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[Group('item')]
#[Group('vo')]
class ItemCodeVOTest extends TestCase
{
    public function test_code_return_value()
    {
        $code = new ItemCode(
            new BrandCode(1),
            new TypeItemCode(1),
            new TypeCode(1)
        );

        $this->assertEquals('1.1.001.001.0001', $code->value);
        $this->assertEquals(16, strlen($code->value));
    }
}
