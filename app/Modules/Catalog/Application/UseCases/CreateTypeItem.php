<?php

namespace App\Modules\Catalog\Application\UseCases;

use App\Modules\Catalog\Application\Commands\CreateTypeItemCommand;
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

    public function handle(CreateTypeItemCommand $dto): TypeItemSimpleDTO
    {
        $code = null;
        if (is_null($dto->code)) {
            $codeVO = $this->repository->findLastCode();
            $code = $this->codeFactory->increment((!$codeVO) ? 0 : $codeVO);
        } else {
            $code = $dto->code;
        }

        $entity = TypeItemEntity::create(
            new NameVO($dto->name),
            new TypeItemCode($code)
        );

        if ($this->repository->isDuplicate($entity)) throw new DomainConflictException("Jenis barang '".$entity->getName()."' dengan code '".($entity->getCode())->value."' sudah tersedia");
        
        $this->repository->save($entity);

        return new TypeItemSimpleDTO(
            $entity->getName(),
            ($entity->getCode())->value
        );
    }
}