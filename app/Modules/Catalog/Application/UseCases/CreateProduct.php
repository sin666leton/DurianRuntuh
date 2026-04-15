<?php

namespace App\Modules\Catalog\Application\UseCases;

use App\Modules\Catalog\Application\Commands\CreateProductCommand;
use App\Modules\Catalog\Domain\Product\Contracts\ProductCommandContract;
use App\Modules\Catalog\Domain\Product\Entities\ProductEntity;
use App\Modules\Catalog\Domain\Product\ValueObjects\ProductCode;
use App\Modules\Catalog\Domain\Project\Contracts\ProjectCommandContract;
use App\Modules\Shared\Application\Response\Response;
use App\Modules\Shared\Domain\Exceptions\DomainConflictException;
use App\Modules\Shared\Domain\Exceptions\DomainException;
use App\Modules\Shared\Domain\Exceptions\DomainNotFoundException;
use App\Modules\Shared\Domain\ValueObjects\NameVO;

class CreateProduct
{
    public function __construct(
        private ProjectCommandContract $project,
        private ProductCommandContract $product
    ) {}

    public function handle(CreateProductCommand $dto): Response
    {
        try {
            if (!$this->project->exists($dto->projectId)) throw new DomainNotFoundException('Project');

            if (is_null($dto->code)) {
                $codeVO = $this->product->findLastCode($dto->projectId);
                $dto->code = intval($codeVO->value)+1;
            }

            $entity = ProductEntity::create(
                $dto->projectId,
                new NameVO($dto->name),
                new ProductCode($dto->code)
            );

            if ($this->product->isDuplicate($entity)) throw new DomainConflictException("Produk '".$entity->getName()."' dengan code '".$entity->getCode()."' sudah tersedia pada projek ini");

            $this->product->save($entity);

            return Response::ok('Produk berhasil ditambahkan');
        } catch (DomainException $th) {
            return Response::fail($th->getMessage());
        }
    }
}