<?php

namespace App\Modules\Authentication\Infrastructure\Repositories;

use App\Modules\Authentication\Application\Contracts\AuthContract;
use Illuminate\Support\Facades\Auth;

class AuthCommandRepository implements AuthContract
{
    public function login(\App\Modules\Authentication\Application\DTOs\LoginCommand $command): bool
    {
        return Auth::attempt(['email' => $command->email, 'password' => $command->password]);
    }

    public function logout(): void
    {
        Auth::logout();
    }
}