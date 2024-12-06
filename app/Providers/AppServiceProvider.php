<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\DiscordServices;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Event;
use OwenIt\Auditing\Events\Audited;
use App\Listeners\SendAuditToDiscordListener;

use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        /*$this->app->singleton(DiscordServices::class, function ($app) {
            return new DiscordServices(env('DISCORD_WEBHOOK_URL'));
        });*/

        Paginator::useBootstrap();
    }

    /**
     * Bootstrap any application services.
     *
     */
    public function boot(): void
    {
        if($this->app->environment('production')){
            URL::forceScheme('https');
        }

        Event::listen(
            Audited::class,
            SendAuditToDiscordListener::class,
        );
    }
}
