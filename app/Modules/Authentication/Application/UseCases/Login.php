<?php

namespace App\Modules\Authentication\Application\UseCases;

use App\Modules\Authentication\Application\Contracts\AuthContract;
use App\Modules\Authentication\Application\DTOs\LoginCommand;
use App\Modules\Shared\Domain\Exceptions\DomainInvalidCredentialsException;

class Login
{
    public function __construct(
        private AuthContract $auth
    ) {}

    public function handle(LoginCommand $command)
    {
        if (!$this->auth->login($command)) throw new DomainInvalidCredentialsException("Email atau password salah.");

        session(['user_name' => auth()->user()->name]);
    }
}