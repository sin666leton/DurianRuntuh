<?php

namespace Tests\Unit\Entities;

use App\Modules\Catalog\Domain\TypeItem\Entities\TypeItemEntity;
use App\Modules\Catalog\Domain\TypeItem\ValueObjects\TypeItemCode;
use App\Modules\Shared\Domain\Exceptions\DomainValidationException;
use App\Modules\Shared\Domain\ValueObjects\NameVO;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[Group('catalog')]
#[Group('typeitem')]
#[Group('entity')]
class TypeItemEntityTest extends TestCase
{
    private TypeItemEntity $entity;

    protected function setUp(): void
    {
        parent::setUp();

        $this->entity = TypeItemEntity::create(
            1,
            new NameVO('Contactor'),
            new TypeItemCode(83)
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
        $this->expectExceptionMessage('ID author tidak dapat diperbarui');
        $this->expectExceptionCode(422);

        $this->entity->setUserId(2);

        $this->assertEquals(1, $this->entity->getId());
    }

    #[Group('create-type-item')]
    public function test_entity_return_value()
    {
        $this->entity->setId(1);
        
        $this->assertEquals('Contactor', $this->entity->getName());
        $this->assertEquals('083', ($this->entity->getCode())->value);
        $this->assertEquals(1, $this->entity->getId());
    }
}
