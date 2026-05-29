<?php

namespace App\Modules\Authentication\Application\UseCases;

use App\Modules\Authentication\Application\Contracts\AuthContract;

class Logout
{
    public function __construct(
        private AuthContract $auth
    ) {}

    public function handle()
    {
        $this->auth->logout();
    }
}