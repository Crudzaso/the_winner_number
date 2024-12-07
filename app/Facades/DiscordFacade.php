<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class DiscordFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'DiscordServices';
    }
}