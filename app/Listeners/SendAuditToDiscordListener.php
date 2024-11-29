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
     *  @param \OwenIt\Auditing\Events\Audited
     * @return void
     */
    public function handle(Audited $event)
    {
        $audit = $event->audit->getAttributes();
        //dd($audit);
        //"event" => "updated"
        //"auditable_type" => "App\Models\Raffle"
        //"auditable_id" => 20
        //"user_type" => "App\Models\User"
        //"user_id" => 5
        //"old_values" => "{"status":1}"
        //"new_values" => "{"status":false}"
        //"ip_address" => "127.0.0.1"
        //"user_agent" => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36"
        //"tags" => null
        //"created_at" => "2023-08-15 19:32:11"
        //"updated_at" => "2023-08-15 19:32:11"
        //"url" => "http://localhost:8000/admin/raffles/20"
        //"id" => 40
        $this->discordServices->discordAuditingNotification(
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
