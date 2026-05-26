<?php

namespace Tests\Unit\UseCases;

use App\Modules\Catalog\Application\Commands\CreateTypeCommand;
use App\Modules\Catalog\Application\DTOs\SimpleTypeDTO;
use App\Modules\Catalog\Application\Services\CodeFactory;
use App\Modules\Catalog\Application\UseCases\CreateType;
use App\Modules\Catalog\Domain\Brand\Contracts\BrandCommandContract;
use App\Modules\Catalog\Domain\Brand\Entities\BrandEntity;
use App\Modules\Catalog\Domain\Brand\ValueObjects\BrandCode;
use App\Modules\Catalog\Domain\Stock\Contracts\StockCommandContract;
use App\Modules\Catalog\Domain\Type\Contracts\TypeCommandContract;
use App\Modules\Catalog\Domain\Type\Entities\TypeEntity;
use App\Modules\Catalog\Domain\Type\ValueObjects\TypeCode;
use App\Modules\Catalog\Domain\TypeItem\Contracts\TypeItemCommandContract;
use App\Modules\Catalog\Domain\TypeItem\Entities\TypeItemEntity;
use App\Modules\Catalog\Domain\TypeItem\ValueObjects\TypeItemCode;
use App\Modules\Shared\Application\Contracts\DatabaseTransaction;
use App\Modules\Shared\Domain\Exceptions\DomainConflictException;
use App\Modules\Shared\Domain\Exceptions\DomainNotFoundException;
use App\Modules\Shared\Domain\ValueObjects\NameVO;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

#[Group('type')]
#[Group('usecase')]
#[Group('create-type')]
#[Group('catalog')]
class CreateTypeTest extends TestCase
{
    /**
     * @var BrandCommandContract&MockObject
     */
    private BrandCommandContract $brand;

    /**
     * @var TypeItemCommandContract&MockObject
     */
    private TypeItemCommandContract $typeItem;

    /**
     * @var TypeCommandContract&MockObject
     */
    private TypeCommandContract $type;

    /**
     * @var StockCommandContract&MockObject
     */
    private StockCommandContract $stock;

    /**
     * @var DatabaseTransaction&MockObject
     */
    private DatabaseTransaction $db;

    private CreateType $usecase;

    private CreateTypeCommand $command;

    private BrandEntity $brandEntity;
    private TypeItemEntity $typeItemEntity;

    protected function setUp(): void
    {
        $this->brandEntity = new BrandEntity(new NameVO('ABB'), new BrandCode('1'), 1);
        $this->typeItemEntity = new TypeItemEntity(new NameVO('Contactor'), new TypeItemCode('1'), 1);

        $this->brand = $this->createMock(BrandCommandContract::class);
        $this->typeItem = $this->createMock(TypeItemCommandContract::class);
        $this->type = $this->createMock(TypeCommandContract::class);
        $this->stock = $this->createMock(StockCommandContract::class);
        $this->db = $this->createMock(DatabaseTransaction::class);

        $this->usecase = new CreateType(
            $this->brand,
            $this->typeItem,
            $this->stock,
            $this->type,
            new CodeFactory(),
            $this->db
        );

        $this->command = new CreateTypeCommand(
            1,
            1,
            1,
            1,
            '3P 25A AX 25-30-01 220V',
            1
        );
    }

    public function test_create_type_throw_DomainNotFoundException_with_invalid_brand_id()
    {
        $this->expectException(DomainNotFoundException::class);
        $this->expectExceptionCode(404);
        $this->expectExceptionMessage('Merk tidak ditemukan');

        $this->brand
            ->expects($this->once())
            ->method('find')
            ->with(1)
            ->willReturn(null);

        $this->usecase->handle($this->command);
    }

    public function test_create_type_throw_DomainNotFoundException_with_invalid_type_item_id()
    {
        $this->expectException(DomainNotFoundException::class);
        $this->expectExceptionCode(404);
        $this->expectExceptionMessage('Jenis Barang tidak ditemukan');

        $this->brand
            ->expects($this->once())
            ->method('find')
            ->with(1)
            ->willReturn($this->brandEntity);

        $this->typeItem
            ->expects($this->once())
            ->method('find')
            ->with(1)
            ->willReturn(null);

        $this->usecase->handle($this->command);
    }

    public function test_create_type_throw_DomainConflictException_with_invalid_duplicated_code()
    {
        $this->expectException(DomainConflictException::class);
        $this->expectExceptionCode(409);
        $this->expectExceptionMessage("Tipe '3P 25A AX 25-30-01 220V' dengan code '0001' sudah tersedia");

        $this->brand
            ->expects($this->once())
            ->method('find')
            ->with(1)
            ->willReturn($this->brandEntity);

        $this->typeItem
            ->expects($this->once())
            ->method('find')
            ->with(1)
            ->willReturn($this->typeItemEntity);

        $this->type
            ->expects($this->once())
            ->method('isDuplicate')
            ->with($this->callback(function ($entity) {
                return $entity instanceof TypeEntity
                && $entity->getUserId() === 1
                && $entity->getProductId() === 1
                && $entity->getBrandId() === 1
                && $entity->getTypeItemId() === 1
                && $entity->getName() === '3P 25A AX 25-30-01 220V'
                && $entity->getCode() instanceof TypeCode
                && $entity->getId() === null;
            }))
            ->willReturn(true);

        $this->usecase->handle($this->command);
    }

    public function test_create_type_should_return_SimpleTypeDTO_when_code_are_null_and_last_code_is_null()
    {
        $this->brand
            ->expects($this->once())
            ->method('find')
            ->with(1)
            ->willReturn($this->brandEntity);

        $this->typeItem
            ->expects($this->once())
            ->method('find')
            ->with(1)
            ->willReturn($this->typeItemEntity);

        $this->type
            ->expects($this->once())
            ->method('findLastCode')
            ->with(1, 1)
            ->willReturn(null);

        $this->type
            ->expects($this->once())
            ->method('isDuplicate')
            ->with($this->callback(function ($entity) {
                return $entity instanceof TypeEntity
                && $entity->getUserId() === 1
                && $entity->getProductId() === 1
                && $entity->getBrandId() === 1
                && $entity->getTypeItemId() === 1
                && $entity->getName() === '3P 25A AX 25-30-01 220V'
                && $entity->getCode() instanceof TypeCode
                && $entity->getId() === null;
            }))
            ->willReturn(false);

        $this->type
            ->expects($this->once())
            ->method('save')
            ->with($this->callback(function ($entity) {
                return $entity instanceof TypeEntity
                && $entity->getUserId() === 1
                && $entity->getProductId() === 1
                && $entity->getBrandId() === 1
                && $entity->getTypeItemId() === 1
                && $entity->getName() === '3P 25A AX 25-30-01 220V'
                && $entity->getCode() instanceof TypeCode
                && $entity->getId() === null;
            }))
            ->willReturnCallback(function ($entity) {
                $entity->setId(1);
            });


        $res = $this->usecase->handle(new CreateTypeCommand(
            1,
            1,
            1,
            1,
            '3P 25A AX 25-30-01 220V',
            null
        ));

        $this->assertInstanceOf(SimpleTypeDTO::class, $res);
        $this->assertEquals('3P 25A AX 25-30-01 220V', $res->name);
        $this->assertEquals(1, $res->id);
        $this->assertEquals('0001', $res->code);
    }

    public function test_create_type_should_return_SimpleTypeDTO_when_code_are_null()
    {
        $this->brand
            ->expects($this->once())
            ->method('find')
            ->with(1)
            ->willReturn($this->brandEntity);

        $this->typeItem
            ->expects($this->once())
            ->method('find')
            ->with(1)
            ->willReturn($this->typeItemEntity);

        $this->type
            ->expects($this->once())
            ->method('findLastCode')
            ->with(1, 1)
            ->willReturn(new TypeCode(1));

        $this->type
            ->expects($this->once())
            ->method('isDuplicate')
            ->with($this->callback(function ($entity) {
                return $entity instanceof TypeEntity
                && $entity->getUserId() === 1
                && $entity->getProductId() === 1
                && $entity->getBrandId() === 1
                && $entity->getTypeItemId() === 1
                && $entity->getName() === '3P 25A AX 25-30-01 220V'
                && $entity->getCode() instanceof TypeCode
                && $entity->getId() === null;
            }))
            ->willReturn(false);

        $this->type
            ->expects($this->once())
            ->method('save')
            ->with($this->callback(function ($entity) {
                return $entity instanceof TypeEntity
                && $entity->getUserId() === 1
                && $entity->getProductId() === 1
                && $entity->getBrandId() === 1
                && $entity->getTypeItemId() === 1
                && $entity->getName() === '3P 25A AX 25-30-01 220V'
                && $entity->getCode() instanceof TypeCode
                && $entity->getId() === null;
            }))
            ->willReturnCallback(function ($entity) {
                $entity->setId(1);
            });


        $res = $this->usecase->handle(new CreateTypeCommand(
            1,
            1,
            1,
            1,
            '3P 25A AX 25-30-01 220V',
            null
        ));

        $this->assertInstanceOf(SimpleTypeDTO::class, $res);
        $this->assertEquals('3P 25A AX 25-30-01 220V', $res->name);
        $this->assertEquals(1, $res->id);
        $this->assertEquals('0002', $res->code);
    }

    public function test_create_type_should_return_SimpleTypeDTO()
    {
        $this->brand
            ->expects($this->once())
            ->method('find')
            ->with(1)
            ->willReturn($this->brandEntity);

        $this->typeItem
            ->expects($this->once())
            ->method('find')
            ->with(1)
            ->willReturn($this->typeItemEntity);

        $this->type
            ->expects($this->never())
            ->method('findLastCode');

        $this->type
            ->expects($this->once())
            ->method('isDuplicate')
            ->with($this->callback(function ($entity) {
                return $entity instanceof TypeEntity
                && $entity->getUserId() === 1
                && $entity->getBrandId() === 1
                && $entity->getTypeItemId() === 1
                && $entity->getName() === '3P 25A AX 25-30-01 220V'
                && $entity->getCode() instanceof TypeCode
                && $entity->getId() === null;
            }))
            ->willReturn(false);

        $this->type
            ->expects($this->once())
            ->method('save')
            ->with($this->callback(function ($entity) {
                return $entity instanceof TypeEntity
                && $entity->getUserId() === 1
                && $entity->getBrandId() === 1
                && $entity->getTypeItemId() === 1
                && $entity->getName() === '3P 25A AX 25-30-01 220V'
                && $entity->getCode() instanceof TypeCode
                && $entity->getId() === null;
            }))
            ->willReturnCallback(function ($entity) {
                $entity->setId(1);
            });


        $res = $this->usecase->handle(new CreateTypeCommand(
            1,
            1,
            1,
            1,
            '3P 25A AX 25-30-01 220V',
            2
        ));

        $this->assertInstanceOf(SimpleTypeDTO::class, $res);
        $this->assertEquals('3P 25A AX 25-30-01 220V', $res->name);
        $this->assertEquals(1, $res->id);
        $this->assertEquals('0002', $res->code);
    }
}
