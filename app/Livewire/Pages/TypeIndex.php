<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class TypeIndex extends Component
{
    public function render()
    {
        return view('livewire.pages.types.index')
            ->layout('layouts.dashboard');
    }
}