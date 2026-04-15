<?php

namespace App\Modules\Catalog\Application\UseCases;

use App\Modules\Catalog\Application\DTOs\SimpleListProjectDTO;
use App\Modules\Catalog\Application\Mappers\ProjectDTOMapper;
use App\Modules\Catalog\Domain\Project\Contracts\ProjectQueryContract;

class GetLatestProject
{
    public function __construct(
        private ProjectQueryContract $query
    ) {}

    /**
     * @return SimpleListProjectDTO[]
     */
    public function handle(): array
    {
        $result = $this->query->getLatest(10);
        
        return ProjectDTOMapper::simpleToSimpleList($result);
    }
}