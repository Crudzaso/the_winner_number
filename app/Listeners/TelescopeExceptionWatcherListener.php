<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Telescope\IncomingEntry;
use Laravel\Telescope\Events\ExceptionRecorded;
use Laravel\Telescope\Events\RequestRecorded;

use Laravel\Telescope\Telescope;
use App\Services\DiscordServices;

class TelescopeExceptionWatcherListener
{
    private DiscordServices $discordServices;
    /**
     * Create the event listener.
     */
    public function __construct(
        DiscordServices $discordServices
    )
    {
        $this->discordServices = $discordServices;
    }

    /**
     * Handle the event.
     */
    public function handle(IncomingEntry $entry): void
    {
        if ($entry->isException()) {
            $this->discordServices->discordExceptionNotification($entry->content['type'], $entry->content['class'], $entry->content['message'], $entry->content['file'], $entry->content['line'], $entry->content['trace'], $entry->content['batchId'], $entry->content['created_at']);
        }
        if ($entry->isRequest()) {
            $this->discordServices->discordRequestNotification($entry->content['type'], $entry->content['method'], $entry->content['uri'], $entry->content['ip'], $entry->content['headers'], $entry->content['response_status'], $entry->content['batchId'], $entry->content['created_at']);
        }
    }
}
