<?php

namespace App\Livewire\Components;

use App\Modules\Authentication\Application\UseCases\Logout;
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

            $this->name = $currentUser->name;
            $this->username = $currentUser->username;
        }

        $path = explode("/", $request->path());
        $this->currentPage = $path[0];
    }

    public function logout(Logout $usecase)
    {
        $usecase->handle();

        return redirect()->route('login');
    }

    public function render()
    {
        return view('components.sidebar');
    }
}