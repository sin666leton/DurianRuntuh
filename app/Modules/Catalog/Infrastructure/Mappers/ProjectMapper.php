<?php

namespace App\Modules\Catalog\Infrastructure\Mappers;

use Illuminate\Database\Eloquent\Collection;

class ProjectMapper
{
    /**
     * @param Collection $collection
     * @return array<array{
     *  id: int,
     *  name: string,
     *  code: string
     * }>
     */
    public static function collectionToSimpleArray(Collection $collection): array
    {
        return $collection->map(fn($project) => [
            'id' => $project->id,
            'name' => $project->name,
            'code' => $project->code
        ])
        ->toArray();
    }
}