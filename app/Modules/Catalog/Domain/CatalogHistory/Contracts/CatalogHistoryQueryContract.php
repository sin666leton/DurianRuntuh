<?php

namespace App\Modules\Catalog\Domain\CatalogHistory\Contracts;

use App\Modules\Catalog\Domain\CatalogHistory\Entities\CatalogHistoryEntity;

interface CatalogHistoryQueryContract
{
    /**
     * Ambil histori katalog
     * 
     * @param int $limit,
     * @param int $offset,
     * 
     * @return array<int, array{
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
    public function get(int $limit, int $offset): array;
}