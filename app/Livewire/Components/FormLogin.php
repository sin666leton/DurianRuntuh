<?php

namespace App\Livewire\Components;

use App\Modules\Authentication\Application\DTOs\LoginCommand;
use App\Modules\Authentication\Application\UseCases\Login;
use Livewire\Component;

class FormLogin extends Component
{
    public string $errorMessage = '';

    public string $email = '';

    public string $password=  '';

    public function submit(Login $usecase)
    {
        try {
            $usecase->handle(new LoginCommand(
                $this->email,
                $this->password
            ));

            return redirect('/home');
        } catch (\Throwable $th) {
            $this->errorMessage = $th->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.components.form-login');
    }
}