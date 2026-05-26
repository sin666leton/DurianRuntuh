<?php

namespace Tests\Unit\UseCases;

use App\Modules\Catalog\Application\Commands\CreateTypeItemCommand;
use App\Modules\Catalog\Application\DTOs\TypeItemSimpleDTO;
use App\Modules\Catalog\Application\Services\CodeFactory;
use App\Modules\Catalog\Application\UseCases\CreateTypeItem;
use App\Modules\Catalog\Domain\TypeItem\Contracts\TypeItemCommandContract;
use App\Modules\Catalog\Domain\TypeItem\Entities\TypeItemEntity;
use App\Modules\Catalog\Domain\TypeItem\ValueObjects\TypeItemCode;
use App\Modules\Shared\Domain\Exceptions\DomainConflictException;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

#[Group('usecase')]
#[Group('typeitem')]
#[Group('catalog')]
#[Group('create-type-item')]
class CreateTypeItemTest extends TestCase
{
    private CreateTypeItem $useCase;

    /**
     * @var TypeItemCommandContract&MockObject
     */
    private TypeItemCommandContract $product;

    protected function setUp(): void
    {
        parent::setUp();

        $this->product = $this->createMock(TypeItemCommandContract::class);

        $this->useCase = new CreateTypeItem(
            $this->product,
            new CodeFactory()
        );
    }

    public function test_create_type_item_throw_DomainConflictException_when_duplicated()
    {
        $this->expectException(DomainConflictException::class);
        $this->expectExceptionMessage("Jenis barang 'Contactor' dengan code '083' sudah tersedia");
        $this->expectExceptionCode(409);
        
        $this->product
            ->expects($this->once())
            ->method('isDuplicate')
            ->with($this->callback(function ($entity) {
                return $entity instanceof TypeItemEntity
                && $entity->getCode() instanceof TypeItemCode
                && $entity->getName() === 'Contactor';
            }))
            ->willReturn(true);

        $this->useCase->handle(new CreateTypeItemCommand(
            'Contactor',
            83
        ));
    }

    public function test_create_type_item_should_return_TypeItemSimpleDTO_with_null_code()
    {
        $this->product
            ->expects($this->once())
            ->method('findLastCode')
            ->willReturn(new TypeItemCode(82));

        $this->product
            ->expects($this->once())
            ->method('isDuplicate')
            ->with($this->callback(function ($entity) {
                return $entity instanceof TypeItemEntity
                && $entity->getCode() instanceof TypeItemCode
                && $entity->getName() === 'Contactor';
            }))
            ->willReturn(false);

        $this->product
            ->expects($this->once())
            ->method('save')
            ->with($this->callback(function ($entity) {
                return $entity instanceof TypeItemEntity
                && $entity->getCode() instanceof TypeItemCode
                && $entity->getName() === 'Contactor';
            }));

        $res = $this->useCase->handle(new CreateTypeItemCommand(
            'Contactor'
        ));

        $this->assertInstanceOf(TypeItemSimpleDTO::class, $res);
        $this->assertEquals('083', $res->code);
        $this->assertEquals('Contactor', $res->name);
    }

    public function test_create_type_item_should_return_TypeItemSimpleDTO_with_code()
    {
        $this->product
            ->expects($this->never())
            ->method('findLastCode');

        $this->product
            ->expects($this->once())
            ->method('isDuplicate')
            ->with($this->callback(function ($entity) {
                return $entity instanceof TypeItemEntity
                && $entity->getCode() instanceof TypeItemCode
                && $entity->getName() === 'Contactor';
            }))
            ->willReturn(false);

        $this->product
            ->expects($this->once())
            ->method('save')
            ->with($this->callback(function ($entity) {
                return $entity instanceof TypeItemEntity
                && $entity->getCode() instanceof TypeItemCode
                && $entity->getName() === 'Contactor';
            }));

        $res = $this->useCase->handle(new CreateTypeItemCommand(
            'Contactor',
            83
        ));

        $this->assertInstanceOf(TypeItemSimpleDTO::class, $res);
        $this->assertEquals('083', $res->code);
        $this->assertEquals('Contactor', $res->name);
    }

    public function test_create_type_item_should_return_TypeItemSimpleDTO_with_null_code_when_last_code_is_null()
    {
        $this->product
            ->expects($this->once())
            ->method('findLastCode')
            ->willReturn(null);

        $this->product
            ->expects($this->once())
            ->method('isDuplicate')
            ->with($this->callback(function ($entity) {
                return $entity instanceof TypeItemEntity
                && $entity->getCode() instanceof TypeItemCode
                && $entity->getName() === 'Contactor';
            }))
            ->willReturn(false);

        $this->product
            ->expects($this->once())
            ->method('save')
            ->with($this->callback(function ($entity) {
                return $entity instanceof TypeItemEntity
                && $entity->getCode() instanceof TypeItemCode
                && $entity->getName() === 'Contactor';
            }));

        $res = $this->useCase->handle(new CreateTypeItemCommand(
            'Contactor',
            null
        ));

        $this->assertInstanceOf(TypeItemSimpleDTO::class, $res);
        $this->assertEquals('001', $res->code);
        $this->assertEquals('Contactor', $res->name);
    }
}
