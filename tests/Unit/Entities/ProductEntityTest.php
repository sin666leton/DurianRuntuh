<?php

namespace Tests\Unit\Entities;

use App\Modules\Catalog\Domain\Product\Entities\ProductEntity;
use App\Modules\Catalog\Domain\Product\ValueObjects\ProductCode;
use App\Modules\Shared\Domain\Exceptions\DomainValidationException;
use App\Modules\Shared\Domain\ValueObjects\NameVO;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[Group('entity')]
#[Group('product')]
class ProductEntityTest extends TestCase
{
    private ProductEntity $entity;

    protected function setUp(): void
    {
        parent::setUp();

        $this->entity = ProductEntity::create(
            new NameVO('Product'),
            new ProductCode('1')
        );
    }

    public function test_set_id_throw_DomainValidationException_when_id_already_filled()
    {
        $this->expectException(DomainValidationException::class);
        $this->expectExceptionMessage('ID tidak dapat diperbarui');
        $this->expectExceptionCode(422);

        $this->entity->setId(1);
        $this->entity->setId(2);

        $this->assertEquals(1, $this->entity->getId());
    }

    public function test_entity_return_value()
    {
        $this->entity->setId(1);
        
        $this->assertEquals('Product', $this->entity->getName());
        $this->assertEquals('1', $this->entity->getCode());
        $this->assertEquals(1, $this->entity->getId());
    }
}
