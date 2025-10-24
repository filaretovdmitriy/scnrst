<?php

namespace App\Providers;

use App\Services\Rewrite\RewriteService;
use App\Services\Rewrite\RewriteServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RewriteServiceInterface::class, RewriteService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
