<?php

namespace Tests\Unit\Entities;

use App\Modules\Catalog\Domain\Type\Entities\TypeEntity;
use App\Modules\Catalog\Domain\Type\ValueObjects\TypeCode;
use App\Modules\Shared\Domain\Exceptions\DomainValidationException;
use App\Modules\Shared\Domain\ValueObjects\NameVO;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[Group('catalog')]
#[Group('entity')]
#[Group('type')]
class TypeEntityTest extends TestCase
{
    private TypeEntity $entity;

    protected function setUp(): void
    {
        parent::setUp();

        $this->entity = TypeEntity::create(
            1,
            1,
            1,
            new NameVO('3P 25A AX 25-30-01 220V'),
            new TypeCode(1)
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

    public function test_set_id_throw_DomainValidationException_when_user_id_already_filled()
    {
        $this->expectException(DomainValidationException::class);
        $this->expectExceptionMessage('ID Author tidak dapat diperbarui');
        $this->expectExceptionCode(422);

        $this->entity->setUserId(2);

        $this->assertEquals(1, $this->entity->getUserId());
    }

    public function test_set_brand_id_throw_DomainValidationException_when_id_already_filled()
    {
        $this->expectException(DomainValidationException::class);
        $this->expectExceptionMessage('ID Merk tidak dapat diperbarui');
        $this->expectExceptionCode(422);

        $this->entity->setBrandId(2);

        $this->assertEquals(1, $this->entity->getBrandId());
    }

    public function test_set_type_item_id_throw_DomainValidationException_when_id_already_filled()
    {
        $this->expectException(DomainValidationException::class);
        $this->expectExceptionMessage('ID Jenis Barang tidak dapat diperbarui');
        $this->expectExceptionCode(422);

        $this->entity->setTypeItemId(2);

        $this->assertEquals(1, $this->entity->getTypeItemId());
    }

    #[Group('create-type')]
    public function test_entity_return_value()
    {
        $this->entity->setId(1);
        
        $this->assertEquals('3P 25A AX 25-30-01 220V', $this->entity->getName());
        $this->assertEquals(1, $this->entity->getId());
        $this->assertEquals(1, $this->entity->getBrandId());
        $this->assertEquals(1, $this->entity->getTypeItemId());
        $this->assertInstanceOf(TypeCode::class, $this->entity->getCode());
        $this->assertEquals('0001', ($this->entity->getCode())->value);
    }
}
