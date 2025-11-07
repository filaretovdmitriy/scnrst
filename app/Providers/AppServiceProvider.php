<?php

namespace App\Providers;

use App\Interfaces\Ai\IAiClient;
use App\Services\Ai\AiClient;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->singleton(IAiClient::class, function ($app) {
            $config = config('services.gigachat');
            return new AiClient(
                $config['base_url'],
                $config['client_secret'],
                $config['auth_url'],
                $config['default_prompt'],
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
