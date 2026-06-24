<?php

namespace App\Modules\Catalog\Application\UseCases;

use App\Modules\Catalog\Application\Commands\CreateBrandCommand;
use App\Modules\Catalog\Application\DTOs\SimpleBrandDTO;
use App\Modules\Catalog\Application\Services\CodeFactory;
use App\Modules\Catalog\Domain\Brand\Contracts\BrandCommandContract;
use App\Modules\Catalog\Domain\Brand\Entities\BrandEntity;
use App\Modules\Catalog\Domain\Brand\ValueObjects\BrandCode;
use App\Modules\Shared\Domain\Exceptions\DomainConflictException;
use App\Modules\Shared\Domain\ValueObjects\NameVO;

class CreateBrand
{
    public function __construct(
        private BrandCommandContract $repository,
        private CodeFactory $codeFactory
    ) {}

    public function handle(CreateBrandCommand $dto): SimpleBrandDTO
    {
        $code = null;
        if (is_null($dto->code)) {
            $codeVO = $this->repository->findLastCode();
            $code = $this->codeFactory->increment($codeVO);
        } else {
            $code = $dto->code;
        }

        $entity = BrandEntity::create(
            $dto->userId,
            new NameVO($dto->name),
            new BrandCode($code)
        );

        if ($this->repository->isDuplicate($entity)) throw new DomainConflictException("Master Merk '".$entity->getName()."' atau kode Master Merk '".($entity->getCode())->value."' sudah tersedia");
        
        $this->repository->save($entity);

        return new SimpleBrandDTO(
            $entity->getId(),
            $entity->getName(),
            ($entity->getCode())->value
        );
    }
}