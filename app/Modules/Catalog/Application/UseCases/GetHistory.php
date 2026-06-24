<?php

namespace App\Modules\Catalog\Application\UseCases;

use App\Modules\Catalog\Application\DTOs\ListHistoryDTO;
use App\Modules\Catalog\Domain\CatalogHistory\Contracts\CatalogHistoryQueryContract;

class GetHistory
{
    public function __construct(
        private CatalogHistoryQueryContract $query
    ) {}

    public function handle(int $limit, int $offset): ListHistoryDTO
    {
        $result = $this->query->get($limit, $offset);

        $hasMore = count($result) > $limit;
        $data = array_slice($result, 0, $limit);

        return new ListHistoryDTO(
            $data,
            $hasMore,
        );
    }
}