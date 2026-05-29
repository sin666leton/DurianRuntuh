<?php

namespace Tests\Unit\ValueObjects;

use App\Modules\Catalog\Domain\Item\ValueObjects\ItemDescriptionVO;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[Group('item')]
#[Group('vo')]
class ItemDescriptionVOTest extends TestCase
{
    public function test_item_description_should_have_a_right_format()
    {
        $vo = new ItemDescriptionVO(
            'Contactor',
            'ABCDEF',
            'ABB'
        );

        $this->assertEquals('Contactor ABCDEF, ABB', $vo->value);
    }
}
