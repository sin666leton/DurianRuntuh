<?php

namespace App\Providers;

use App\Modules\Catalog\Domain\Brand\Contracts\BrandCommandContract;
use App\Modules\Catalog\Domain\Brand\Contracts\BrandQueryContract;
use App\Modules\Catalog\Infrastructure\Repositories\Commands\BrandCommandRepository;
use App\Modules\Catalog\Infrastructure\Repositories\Queries\BrandQueryRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BrandQueryContract::class, BrandQueryRepository::class);
        $this->app->bind(BrandCommandContract::class, BrandCommandRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
