<?php

namespace App\Modules\Authentication\Application\DTOs;

readonly class LoginCommand
{
    public function __construct(
        public string $email,
        public string $password
    ) {}
}