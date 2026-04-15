<?php

namespace App\Modules\Catalog\Domain\Project\Contracts;

interface ProjectCommandContract
{
    public function exists(int $id): bool;
}