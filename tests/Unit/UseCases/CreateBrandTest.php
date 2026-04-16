<?php

namespace Tests\Unit\UseCases;

use App\Modules\Catalog\Application\Commands\CreateBrandCommand;
use App\Modules\Catalog\Application\DTOs\BrandSimpleDTO;
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
class CreateBrandTest extends TestCase
{
    private CreateBrand $useCase;

    /**
     * @var BrandCommandContract&MockObject
     */
    private BrandCommandContract $product;

    protected function setUp(): void
    {
        parent::setUp();

        $this->product = $this->createMock(BrandCommandContract::class);

        $this->useCase = new CreateBrand(
            $this->product
        );
    }

    public function test_create_brand_throw_DomainConflictException_when_duplicated()
    {
        $this->expectException(DomainConflictException::class);
        $this->expectExceptionMessage("Merk 'ABB' dengan code '001' sudah tersedia");
        $this->expectExceptionCode(409);
        
        $this->product
            ->expects($this->once())
            ->method('isDuplicate')
            ->with($this->callback(function ($entity) {
                return $entity instanceof BrandEntity
                && $entity->getCode() === '001'
                && $entity->getName() === 'ABB';
            }))
            ->willReturn(true);

        $this->useCase->handle(new CreateBrandCommand(
            'ABB',
            1
        ));
    }

    public function test_create_brand_should_return_BrandSimpleDTO_with_null_code()
    {
        $this->product
            ->expects($this->once())
            ->method('findLastCode')
            ->willReturn(new BrandCode(1));

        $this->product
            ->expects($this->once())
            ->method('isDuplicate')
            ->with($this->callback(function ($entity) {
                return $entity instanceof BrandEntity
                && $entity->getCode() === '002'
                && $entity->getName() === 'ABB';
            }))
            ->willReturn(false);

        $this->product
            ->expects($this->once())
            ->method('save')
            ->with($this->callback(function ($entity) {
                return $entity instanceof BrandEntity
                && $entity->getCode() === '002'
                && $entity->getName() === 'ABB';
            }));

        $res = $this->useCase->handle(new CreateBrandCommand(
            'ABB'
        ));

        $this->assertInstanceOf(BrandSimpleDTO::class, $res);
        $this->assertEquals('002', $res->code);
        $this->assertEquals('ABB', $res->name);
    }

    public function test_create_brand_should_return_BrandSimpleDTO_with_code()
    {
        $this->product
            ->expects($this->never())
            ->method('findLastCode');

        $this->product
            ->expects($this->once())
            ->method('isDuplicate')
            ->with($this->callback(function ($entity) {
                return $entity instanceof BrandEntity
                && $entity->getCode() === '001'
                && $entity->getName() === 'ABB';
            }))
            ->willReturn(false);

        $this->product
            ->expects($this->once())
            ->method('save')
            ->with($this->callback(function ($entity) {
                return $entity instanceof BrandEntity
                && $entity->getCode() === '001'
                && $entity->getName() === 'ABB';
            }));

        $res = $this->useCase->handle(new CreateBrandCommand(
            'ABB',
            1
        ));

        $this->assertInstanceOf(BrandSimpleDTO::class, $res);
        $this->assertEquals('001', $res->code);
        $this->assertEquals('ABB', $res->name);
    }
}
