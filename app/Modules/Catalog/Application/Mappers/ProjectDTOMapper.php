<?php

namespace App\Modules\Catalog\Application\Mappers;

use App\Modules\Catalog\Application\DTOs\SimpleListProjectDTO;

class ProjectDTOMapper
{
    /**
     * @return SimpleListProjectDTO[]
     */
    public static function simpleToSimpleList(array $data): array
    {
        return array_map(fn($project) => new SimpleListProjectDTO(
            $project['id'],
            $project['name']." - ".$project['code']
        ), $data);
    }
}