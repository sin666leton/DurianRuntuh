<?php

namespace App\Modules\Shared\Infrastructure\Repositories;

use App\Modules\Shared\Application\Contracts\DatabaseTransaction;
use Illuminate\Support\Facades\DB;

class DatabaseTransactionRepository implements DatabaseTransaction
{
    public function start(): void
    {
        DB::beginTransaction();
    }

    public function commit(): void
    {
        DB::commit();
    }

    public function rollback(): void
    {
        DB::rollBack();
    }
}