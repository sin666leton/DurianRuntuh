<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Sidebar extends Component
{
    public $name;
    public $username;
    public $currentPage;

    public function mount()
    {
        $request = request();

        if (!$this->name) {
            $currentUser = $request->user();

            // TESTING
            $this->name = strtoupper("Ujang Kedu");
            $this->username = "ujangkedu123";
            
            // $this->name = $currentUser->name;
            // $this->username = $currentUser->username;
        }

        $path = explode("/", $request->path());
        $this->currentPage = $path[0];
    }

    public function render()
    {
        return view('components.sidebar');
    }
}