<?php

namespace App\Modules\Catalog\Domain\CatalogHistory\Enums;

enum CatalogActionEnum: string
{
    case CREATE = 'CREATE';
    case UPDATE = 'UPDATE';
    case DELETE = 'DELETE';
}