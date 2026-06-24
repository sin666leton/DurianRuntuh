<?php

namespace App\Modules\Catalog\Infrastructure\Repositories\Queries;

use App\Models\CatalogHistory;
use App\Modules\Catalog\Domain\CatalogHistory\Contracts\CatalogHistoryQueryContract;

class CatalogHistoryQueryRepository implements CatalogHistoryQueryContract
{
    public function get(int $limit, int $offset): array
    {
        $result = CatalogHistory::select([
            'id',
            'user_id',
            'action',
            'model_type',
            'changes',
            'created_at',
        ])
        ->latest()
        ->with(
            'user',
            function ($user) {
                $user->select(['id', 'name']);
            }
        )
        ->offset($offset)
        ->take($limit + 1)
        ->get();

        return $result
            ->map(fn($history) => [
                'action' => $history->action,
                'modelType' => $history->model_type,
                'changes' => json_decode($history->changes, true),
                'createdAt' => $history->created_at->diffForHumans(),
                'name' => $history->user->name
            ])
            ->toArray();
    }
}