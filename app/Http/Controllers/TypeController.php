<?php

namespace App\Http\Controllers;

use App\Modules\Catalog\Application\UseCases\GetAllProduct;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function create(GetAllProduct $usecase)
    {
        $res = $usecase->handle();
        return view('admin.types.create', ['products' => $res]);
    }
}
