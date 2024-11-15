<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Purchase;

class Raffle extends Model
{
    protected $guarded=[];

    protected $cast=[
        'start_date' => 'date',
        'closing_date' => 'date'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function purchases():HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    protected $casts = [
        'status' => 'boolean',
    ];
}


