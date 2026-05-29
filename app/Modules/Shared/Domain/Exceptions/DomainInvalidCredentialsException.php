<?php

namespace App\Modules\Shared\Domain\Exceptions;


class DomainInvalidCredentialsException extends DomainException
{
    public function __construct(string $message = "")
    {
        parent::__construct($message, 401);
    }
}