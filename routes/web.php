<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\DashboardController;
use App\Livewire\Pages\BrandIndex;
use App\Livewire\Pages\Home;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::livewire('home', Home::class);
Route::livewire('brands', BrandIndex::class);