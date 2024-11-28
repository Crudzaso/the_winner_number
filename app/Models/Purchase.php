<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Raffle;

use OwenIt\Auditing\Contracts\Auditable;

class Purchase extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;

    protected $auditInclude = [
        'id',
        'user_id',
        'raffle_id',
        'number',
    ];

    protected $auditExclude = [];

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
