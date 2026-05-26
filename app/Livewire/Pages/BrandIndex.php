<?php

namespace App\Livewire\Pages;

use App\Modules\Catalog\Application\UseCases\PaginateBrand;
use Livewire\Component;

class BrandIndex extends Component
{
    public function render()
    {
        return view('livewire.pages.brand.index')
            ->layout('layouts.dashboard');
    }
}