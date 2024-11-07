<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use app\Models\user;
use app\Models\raffle;

class Purchases extends Model
{
    protected $guarded=[];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function raffle():BelongsTo
    {
        return $this->belongsTo(Raffle::class);
    }
}
