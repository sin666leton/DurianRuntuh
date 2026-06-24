<?php

namespace App\Providers;

use App\Modules\Catalog\Application\UseCases\CreateCatalogHistory;
use App\Modules\Catalog\Domain\Brand\Contracts\BrandCommandContract;
use App\Modules\Catalog\Domain\CatalogHistory\Contracts\CatalogHistoryCommandContract;
use App\Modules\Catalog\Domain\Item\Contracts\ItemCommandContract;
use App\Modules\Catalog\Domain\TypeItem\Contracts\TypeItemCommandContract;
use App\Modules\Catalog\Infrastructure\Decorators\BrandCommandHistory;
use App\Modules\Catalog\Infrastructure\Decorators\ItemCommandHistory;
use App\Modules\Catalog\Infrastructure\Decorators\TypeItemCommandHistory;
use Illuminate\Support\ServiceProvider;

class AppDecoratorProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->extend(BrandCommandContract::class, function ($repo, $app) {
            return new BrandCommandHistory(
                $repo,
                $app->make(CatalogHistoryCommandContract::class)
            );
        });

        $this->app->extend(TypeItemCommandContract::class, function ($repo, $app) {
            return new TypeItemCommandHistory(
                $repo,
                $app->make(CatalogHistoryCommandContract::class)
            );
        });

        $this->app->extend(ItemCommandContract::class, function ($repo, $app) {
            return new ItemCommandHistory(
                $repo,
                $app->make(CatalogHistoryCommandContract::class)
            );
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
