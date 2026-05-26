<?php

namespace App\Modules\Catalog\Application\UseCases;

use App\Modules\Catalog\Domain\Brand\Contracts\BrandCommandContract;
use App\Modules\Catalog\Domain\Brand\ValueObjects\BrandCode;

class GetBrandLastCode
{
    public function __construct(
        private BrandCommandContract $repository
    ) {}

    public function handle(): BrandCode|null
    {
        return $this->repository->findLastCode();
    }
}