<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Raffle;

class Purchase extends Model
{
    protected $guarded=[];

    protected $cast=[
        'number' => 'integer'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function raffle():BelongsTo
    {
        return $this->belongsTo(Raffle::class);
    }
}
