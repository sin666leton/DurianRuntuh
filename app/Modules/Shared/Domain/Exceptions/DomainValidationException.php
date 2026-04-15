<?php

namespace App\Modules\Shared\Domain\Exceptions;

class DomainValidationException extends DomainException
{
    public function __construct(string $message = "")
    {
        parent::__construct(
            $message,
            422,
            null
        );
    }
}