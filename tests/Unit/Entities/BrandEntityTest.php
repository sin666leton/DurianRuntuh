<?php

namespace Tests\Unit\Entities;

use App\Modules\Catalog\Domain\Brand\Entities\BrandEntity;
use App\Modules\Catalog\Domain\Brand\ValueObjects\BrandCode;
use App\Modules\Shared\Domain\Exceptions\DomainValidationException;
use App\Modules\Shared\Domain\ValueObjects\NameVO;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[Group('catalog')]
#[Group('entity')]
#[Group('brand')]
class BrandEntityTest extends TestCase
{
    private BrandEntity $entity;

    protected function setUp(): void
    {
        parent::setUp();

        $this->entity = BrandEntity::create(
            new NameVO('ABB'),
            new BrandCode('001')
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
        
        $this->assertEquals('ABB', $this->entity->getName());
        $this->assertEquals('001', $this->entity->getCode());
        $this->assertEquals(1, $this->entity->getId());
    }
}
