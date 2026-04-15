<?php

namespace App\Modules\Catalog\Application\UseCases;

use App\Modules\Catalog\Application\DTOs\SimpleListProjectDTO;
use App\Modules\Catalog\Application\Mappers\ProjectDTOMapper;
use App\Modules\Catalog\Domain\Project\Contracts\ProjectQueryContract;

class SearchProject
{
    public function __construct(
        private ProjectQueryContract $query
    ) {}

    /**
     * @param string $name Nama project
     * @return SimpleListProjectDTO[]
     */
    public function handle(string $name): array
    {
        $result = $this->query->searchByName($name);

        return ProjectDTOMapper::simpleToSimpleList($result);
    }
}