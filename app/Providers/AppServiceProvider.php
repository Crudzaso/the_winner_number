<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\DiscordServices;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(DiscordServices::class, function ($app) {
            return new DiscordServices(env('DISCORD_WEBHOOK_URL'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     */
    public function boot(): void
    {
        //
    }
}
