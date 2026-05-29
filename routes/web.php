<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\AuthOnly;
use App\Livewire\Pages\BrandIndex;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\Login;
use App\Livewire\Pages\TypeIndex;
use App\Livewire\Pages\TypeItemIndex;
use Illuminate\Support\Facades\Route;

Route::livewire('/', Login::class)->name('login');
Route::middleware(AuthOnly::class)->group(function () {
    Route::livewire('home', Home::class);
    Route::livewire('brands', BrandIndex::class);
    Route::livewire('type-items', TypeItemIndex::class);
    Route::livewire('types', TypeIndex::class);
});