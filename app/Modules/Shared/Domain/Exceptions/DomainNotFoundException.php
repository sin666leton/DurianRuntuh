<?php

namespace App\Modules\Shared\Domain\Exceptions;

class DomainNotFoundException extends DomainException
{
    public function __construct(string $domain = "")
    {
        parent::__construct("$domain tidak ditemukan", 404);
    }
}