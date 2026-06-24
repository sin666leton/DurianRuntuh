<?php

namespace App\Modules\Catalog\Application\UseCases;

use App\Modules\Catalog\Application\Commands\CreateTypeCommand;
use App\Modules\Catalog\Application\DTOs\SimpleTypeDTO;
use App\Modules\Catalog\Application\Services\CodeFactory;
use App\Modules\Catalog\Domain\Brand\Contracts\BrandCommandContract;
use App\Modules\Catalog\Domain\Item\Contracts\ItemCommandContract;
use App\Modules\Catalog\Domain\Item\Entities\ItemEntity;
use App\Modules\Catalog\Domain\Item\ValueObjects\ItemCode;
use App\Modules\Catalog\Domain\Item\ValueObjects\ItemDescriptionVO;
use App\Modules\Catalog\Domain\Type\Contracts\TypeCommandContract;
use App\Modules\Catalog\Domain\Type\Entities\TypeEntity;
use App\Modules\Catalog\Domain\Type\ValueObjects\TypeCode;
use App\Modules\Catalog\Domain\TypeItem\Contracts\TypeItemCommandContract;
use App\Modules\Shared\Application\Contracts\DatabaseTransaction;
use App\Modules\Shared\Domain\Exceptions\DomainConflictException;
use App\Modules\Shared\Domain\Exceptions\DomainNotFoundException;
use App\Modules\Shared\Domain\ValueObjects\NameVO;

class CreateType
{
    public function __construct(
        private BrandCommandContract $brand,
        private TypeItemCommandContract $typeItem,
        private ItemCommandContract $item,
        private TypeCommandContract $type,
        private CodeFactory $codeFactory,
        private DatabaseTransaction $transaction
    ) {}
    
    public function handle(CreateTypeCommand $dto): SimpleTypeDTO
    {
        $brandEntity = $this->brand->find($dto->brandId);
        if (!$brandEntity) throw new DomainNotFoundException('Master Merk');

        $typeItemEntity = $this->typeItem->find($dto->typeItemId);
        if (!$typeItemEntity) throw new DomainNotFoundException('Master Jenis Barang');

        $code = null;
        if (!$dto->code) {
            $lastCode = $this->type->findLastCode($brandEntity->getId(), $typeItemEntity->getId());
            $code = $this->codeFactory->increment($lastCode);
        } else {
            $code = $dto->code;
        }

        $typeEntity = TypeEntity::create(
            $dto->userId,
            $brandEntity->getId(),
            $typeItemEntity->getId(),
            new NameVO($dto->name),
            new TypeCode($code)
        );

        if ($this->type->isDuplicate($typeEntity)) throw new DomainConflictException("Master Tipe '".$typeEntity->getName()."' atau kode Master Tipe '".($typeEntity->getCode())->value."' sudah tersedia");

        $this->transaction->start();
        try {
            $this->type->save($typeEntity);
            
            $itemEntity = ItemEntity::create(
                $typeEntity->getId(),
                new ItemDescriptionVO(
                    $typeItemEntity->getName(),
                    $typeEntity->getName(),
                    $brandEntity->getName()
                ),
                new ItemCode(
                    $brandEntity->getCode(),
                    $typeItemEntity->getCode(),
                    $typeEntity->getCode()
                )
            );

            $this->item->save($itemEntity);

            $this->transaction->commit();
        } catch (\Throwable $th) {
            $this->transaction->rollback();

            throw $th;
        }

        return new SimpleTypeDTO(
            $typeEntity->getId(),
            $typeEntity->getName(),
            ($typeEntity->getCode())->value
        );
    }
}