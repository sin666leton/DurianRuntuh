<?php

namespace App\Livewire\Components;

use App\Modules\Authentication\Application\UseCases\Logout;
use Livewire\Component;

class Navbar extends Component
{
    public string $name = '';

    public string $email = '';

    public function mount()
    {
        if (!$this->name) {

            $this->name = session('user_name');
            $this->email = session('user_email');
        }
    }

    public function logout(Logout $usecase)
    {
        $usecase->handle();
        
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.components.navbar');
    }
}