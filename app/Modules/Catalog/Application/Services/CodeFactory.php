<?php

namespace App\Modules\Catalog\Application\Services;

use App\Modules\Shared\Application\Markers\CodeVO;

class CodeFactory
{
    public function increment(int|CodeVO|null $code): int
    {
        if (is_null($code)) return 1;
        else return ((is_object($code)) ? intval($code->value) : $code) + 1;
    }
}