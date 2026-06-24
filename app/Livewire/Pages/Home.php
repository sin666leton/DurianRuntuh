<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Home extends Component
{
    public string $currentUsername = '';

    public function mount()
    {
        $this->currentUsername = session('user_name');
    }

    public function render()
    {
        return view('pages.home')
            ->layout('layouts.dashboard');
    }
}