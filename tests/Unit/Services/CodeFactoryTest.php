<?php

namespace Tests\Unit\Services;

use App\Modules\Catalog\Application\Services\CodeFactory;
use App\Modules\Catalog\Domain\Type\ValueObjects\TypeCode;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[Group('service')]
#[Group('catalog')]
class CodeFactoryTest extends TestCase
{
    private CodeFactory $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new CodeFactory();
    }

    public function test_increment_should_return_int_with_int()
    {
        $res = $this->service->increment(1);

        $this->assertEquals(2, $res);
    }

    public function test_increment_should_return_int_with_zero()
    {
        $res = $this->service->increment(0);

        $this->assertEquals(1, $res);
    }

    public function test_increment_should_return_int_with_string()
    {
        $res = $this->service->increment("0");

        $this->assertEquals(1, $res);
    }

    public function test_increment_should_return_int_with_CodeVO()
    {
        $res = $this->service->increment(new TypeCode(1));

        $this->assertEquals(2, $res);
    }
}
