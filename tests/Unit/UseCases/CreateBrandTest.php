<?php

namespace Tests\Unit\UseCases;

use App\Modules\Catalog\Application\Commands\CreateBrandCommand;
use App\Modules\Catalog\Application\DTOs\SimpleBrandDTO;
use App\Modules\Catalog\Application\Services\CodeFactory;
use App\Modules\Catalog\Application\UseCases\CreateBrand;
use App\Modules\Catalog\Domain\Brand\Contracts\BrandCommandContract;
use App\Modules\Catalog\Domain\Brand\Entities\BrandEntity;
use App\Modules\Catalog\Domain\Brand\ValueObjects\BrandCode;
use App\Modules\Shared\Domain\Exceptions\DomainConflictException;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

#[Group('usecase')]
#[Group('brand')]
#[Group('catalog')]
#[Group('create-brand')]
class CreateBrandTest extends TestCase
{
    private CreateBrand $useCase;

    /**
     * @var BrandCommandContract&MockObject
     */
    private BrandCommandContract $brand;

    protected function setUp(): void
    {
        parent::setUp();

        $this->brand = $this->createMock(BrandCommandContract::class);

        $this->useCase = new CreateBrand(
            $this->brand,
            new CodeFactory()
        );
    }

    public function test_create_brand_throw_DomainConflictException_when_duplicated()
    {
        $this->expectException(DomainConflictException::class);
        $this->expectExceptionMessage("Master Merk 'ABB' atau kode Master Merk '001' sudah tersedia");
        $this->expectExceptionCode(409);
        
        $this->brand
            ->expects($this->once())
            ->method('isDuplicate')
            ->with($this->callback(function ($entity) {
                return $entity instanceof BrandEntity
                && $entity->getCode() instanceof BrandCode
                && $entity->getUserId() === 1
                && $entity->getName() === 'ABB';
            }))
            ->willReturn(true);

        $this->useCase->handle(new CreateBrandCommand(
            1,
            'ABB',
            1
        ));
    }

    public function test_create_brand_should_return_SimpleBrandDTO_with_null_code()
    {
        $this->brand
            ->expects($this->once())
            ->method('findLastCode')
            ->willReturn(new BrandCode(1));

        $this->brand
            ->expects($this->once())
            ->method('isDuplicate')
            ->with($this->callback(function ($entity) {
                return $entity instanceof BrandEntity
                && $entity->getCode() instanceof BrandCode
                && $entity->getUserId() === 1
                && $entity->getName() === 'ABB';
            }))
            ->willReturn(false);

        $this->brand
            ->expects($this->once())
            ->method('save')
            ->with($this->callback(function ($entity) {
                return $entity instanceof BrandEntity
                && $entity->getCode() instanceof BrandCode
                
                && $entity->getName() === 'ABB';
            }))
            ->willReturnCallback(function ($entity) {
                $entity->setId(1);
            });

        $res = $this->useCase->handle(new CreateBrandCommand(
            1,
            'ABB'
        ));

        $this->assertInstanceOf(SimpleBrandDTO::class, $res);
        $this->assertEquals(1, $res->id);
        $this->assertEquals('002', $res->code);
        $this->assertEquals('ABB', $res->name);
    }

    public function test_create_brand_should_return_SimpleBrandDTO_with_code()
    {
        $this->brand
            ->expects($this->never())
            ->method('findLastCode');

        $this->brand
            ->expects($this->once())
            ->method('isDuplicate')
            ->with($this->callback(function ($entity) {
                return $entity instanceof BrandEntity
                && $entity->getCode() instanceof BrandCode
                && $entity->getUserId() === 1
                && $entity->getName() === 'ABB';
            }))
            ->willReturn(false);

        $this->brand
            ->expects($this->once())
            ->method('save')
            ->with($this->callback(function ($entity) {
                return $entity instanceof BrandEntity
                && $entity->getCode() instanceof BrandCode
                && $entity->getUserId() === 1
                && $entity->getName() === 'ABB';
            }))
            ->willReturnCallback(function ($entity) {
                $entity->setId(1);
            });;

        $res = $this->useCase->handle(new CreateBrandCommand(
            1,
            'ABB',
            1
        ));

        $this->assertInstanceOf(SimpleBrandDTO::class, $res);
        $this->assertEquals(1, $res->id);
        $this->assertEquals('001', $res->code);
        $this->assertEquals('ABB', $res->name);
    }

    public function test_create_brand_should_return_SimpleBrandDTO_when_last_code_is_null()
    {
        $this->brand
            ->expects($this->once())
            ->method('findLastCode')
            ->willReturn(null);

        $this->brand
            ->expects($this->once())
            ->method('isDuplicate')
            ->with($this->callback(function ($entity) {
                return $entity instanceof BrandEntity
                && $entity->getCode() instanceof BrandCode
                && $entity->getUserId() === 1
                && $entity->getName() === 'ABB';
            }))
            ->willReturn(false);

        $this->brand
            ->expects($this->once())
            ->method('save')
            ->with($this->callback(function ($entity) {
                return $entity instanceof BrandEntity
                && $entity->getCode() instanceof BrandCode
                && $entity->getUserId() === 1
                && $entity->getName() === 'ABB';
            }))
            ->willReturnCallback(function ($entity) {
                $entity->setId(1);
            });;

        $res = $this->useCase->handle(new CreateBrandCommand(
            1,
            'ABB',
            null
        ));

        $this->assertInstanceOf(SimpleBrandDTO::class, $res);
        $this->assertEquals(1, $res->id);
        $this->assertEquals('001', $res->code);
        $this->assertEquals('ABB', $res->name);
    }
}
