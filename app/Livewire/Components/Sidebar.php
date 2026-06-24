<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Sidebar extends Component
{
    public function mount()
    {
        $request = request();

        $path = explode("/", $request->path());
        $this->currentPage = $path[0];
    }


    public function render()
    {
        return view('components.sidebar');
    }
}