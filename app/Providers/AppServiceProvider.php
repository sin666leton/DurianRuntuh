<?php

namespace App\Providers;

use App\Modules\Authentication\Application\Contracts\AuthContract;
use App\Modules\Authentication\Infrastructure\Repositories\AuthCommandRepository;
use App\Modules\Catalog\Domain\Brand\Contracts\BrandCommandContract;
use App\Modules\Catalog\Domain\Brand\Contracts\BrandQueryContract;
use App\Modules\Catalog\Domain\Item\Contracts\ItemCommandContract;
use App\Modules\Catalog\Domain\Type\Contracts\TypeCommandContract;
use App\Modules\Catalog\Domain\Type\Contracts\TypeQueryContract;
use App\Modules\Catalog\Domain\TypeItem\Contracts\TypeItemCommandContract;
use App\Modules\Catalog\Domain\TypeItem\Contracts\TypeItemQueryContract;
use App\Modules\Catalog\Infrastructure\Repositories\Commands\BrandCommandRepository;
use App\Modules\Catalog\Infrastructure\Repositories\Commands\ItemCommandRepository;
use App\Modules\Catalog\Infrastructure\Repositories\Commands\TypeCommandRepository;
use App\Modules\Catalog\Infrastructure\Repositories\Commands\TypeItemCommandRepository;
use App\Modules\Catalog\Infrastructure\Repositories\Queries\BrandQueryRepository;
use App\Modules\Catalog\Infrastructure\Repositories\Queries\TypeItemQueryRepository;
use App\Modules\Catalog\Infrastructure\Repositories\Queries\TypeQueryRepository;
use App\Modules\Shared\Application\Contracts\DatabaseTransaction;
use App\Modules\Shared\Infrastructure\Repositories\DatabaseTransactionRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Database Transaction
        $this->app->bind(DatabaseTransaction::class, DatabaseTransactionRepository::class);

        // Brand
        $this->app->bind(BrandQueryContract::class, BrandQueryRepository::class);
        $this->app->bind(BrandCommandContract::class, BrandCommandRepository::class);

        // Type Item
        $this->app->bind(TypeItemQueryContract::class, TypeItemQueryRepository::class);
        $this->app->bind(TypeItemCommandContract::class, TypeItemCommandRepository::class);

        // Type
        $this->app->bind(TypeCommandContract::class, TypeCommandRepository::class);
        $this->app->bind(TypeQueryContract::class, TypeQueryRepository::class);

        // Item
        $this->app->bind(ItemCommandContract::class, ItemCommandRepository::class);

        $this->app->bind(AuthContract::class, AuthCommandRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
