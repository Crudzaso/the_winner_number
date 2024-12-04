<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\DiscordServices;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Event;
use OwenIt\Auditing\Events\Audited;
use App\Listeners\SendAuditToDiscordListener;
use Laravel\Telescope\Events\RequestRecorded;
use Laravel\Telescope\Events\ExceptionRecorded;
use App\Listeners\TelescopeExceptionWatcherListener;
use Illuminate\Support\Facades\Schedule;


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
        if($this->app->environment('production')){
            URL::forceScheme('https');
        }

    }

    protected $listen = [
        Audited::class => [
            SendAuditToDiscordListener::class,
        ],
    ];

}
