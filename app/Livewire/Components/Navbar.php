<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Navbar extends Component
{
    private string $name = '';

    public function mount()
    {
        $request = request();

        if (!$this->name) {
            $currentUser = $request->user();

            $this->name = $currentUser->name;
        }
    }

    public function render()
    {
        return view('livewire.components.navbar', [
            'currentUserName' => $this->name
        ]);
    }
}