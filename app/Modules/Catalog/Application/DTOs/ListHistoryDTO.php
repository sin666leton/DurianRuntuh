<?php

namespace App\Modules\Catalog\Application\DTOs;

use App\Modules\Catalog\Domain\CatalogHistory\Entities\CatalogHistoryEntity;

readonly class ListHistoryDTO
{
    public function __construct(
        /**
         * @var array<int, array{
         *  name: string,
         *  modelType: string,
         *  action: string,
         *  changes: array{
         *      before: array<string, mixed>|null,
         *      after: array<string, mixed>
         *  },
         *  createdAt: string
         * }>
         */
        public array $data,
        public bool $hasMore,
    ) {}
}