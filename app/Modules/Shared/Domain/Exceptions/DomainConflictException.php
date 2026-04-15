<?php

namespace App\Modules\Shared\Domain\Exceptions;

class DomainConflictException extends DomainException
{
    public function __construct(string $message = "")
    {
        parent::__construct($message, 409);
    }
}