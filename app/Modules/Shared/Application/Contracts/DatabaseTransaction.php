<?php

namespace App\Modules\Shared\Application\Contracts;

interface DatabaseTransaction
{
    public function start(): void;

    public function rollback(): void;

    public function commit(): void;
}