<?php

namespace App\Modules\Authentication\Application\Contracts;

use App\Modules\Authentication\Application\DTOs\LoginCommand;

interface AuthContract
{
    public function login(LoginCommand $command): bool;

    public function logout(): void;
}