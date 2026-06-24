<?php

namespace App\Modules\Catalog\Application\UseCases;

use App\Modules\Catalog\Application\Commands\CreateTypeItemCommand;
use App\Modules\Catalog\Application\DTOs\SimpleTypeItemDTO;
use App\Modules\Catalog\Application\DTOs\TypeItemSimpleDTO;
use App\Modules\Catalog\Application\Services\CodeFactory;
use App\Modules\Catalog\Domain\TypeItem\Contracts\TypeItemCommandContract;
use App\Modules\Catalog\Domain\TypeItem\Entities\TypeItemEntity;
use App\Modules\Catalog\Domain\TypeItem\ValueObjects\TypeItemCode;
use App\Modules\Shared\Domain\Exceptions\DomainConflictException;
use App\Modules\Shared\Domain\ValueObjects\NameVO;

class CreateTypeItem
{
    public function __construct(
        private TypeItemCommandContract $repository,
        private CodeFactory $codeFactory
    ) {}

    public function handle(CreateTypeItemCommand $dto): SimpleTypeItemDTO
    {
        $code = null;
        if (is_null($dto->code)) {
            $codeVO = $this->repository->findLastCode();
            $code = $this->codeFactory->increment($codeVO);
        } else {
            $code = $dto->code;
        }

        $entity = TypeItemEntity::create(
            $dto->userId,
            new NameVO($dto->name),
            new TypeItemCode($code)
        );

        if ($this->repository->isDuplicate($entity)) throw new DomainConflictException("Master Jenis barang '".$entity->getName()."' atau kode Master Jenis barang '".($entity->getCode())->value."' sudah tersedia");
        
        $this->repository->save($entity);

        return new SimpleTypeItemDTO(
            $entity->getId(),
            $entity->getName(),
            ($entity->getCode())->value
        );
    }
}