<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use OwenIt\Auditing\Events\Audited;
use App\Services\DiscordServices;

class SendAuditToDiscordListener
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
    public function handle(Audited $audit): void
    {
        //dd($audit);
        $this->discordServices->discordAuditingNotification($audit->event, $audit->auditable_type, $audit->auditable_id, $audit->old_values, $audit->new_values, $audit->user_id, $audit->created_at);
    }

}
