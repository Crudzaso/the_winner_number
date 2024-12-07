<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use OwenIt\Auditing\Events\Audited;
use App\Facades\DiscordFacade;

class SendAuditToDiscordListener
{

    private DiscordServices $discordServices;

    /**
     * Create the event listener.
     */
    public function __construct(){}

    /**
     * Handle the event.
     *  @param \OwenIt\Auditing\Events\Audited
     * @return void
     */
    public function handle(Audited $event)
    {
        $audit = $event->audit->getAttributes();
    
        DiscordFacade::discordAuditingNotification(
            $audit['event'], 
            $audit['auditable_type'], 
            $audit['auditable_id'],
            $audit['user_type'], 
            $audit['user_id'], 
            $audit['old_values'], 
            $audit['new_values'],
            $audit['url'],
            $audit['created_at'], 
            $audit['updated_at']
        );
    }

}
