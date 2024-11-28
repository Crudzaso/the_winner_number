<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Raffle;
use App\Models\Purchase;

use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable
{
    use HasApiTokens;
    use HasRoles;
    use \OwenIt\Auditing\Auditable;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $auditInclude = [
        'name',
        'email',
        'phone_number',
        'date_of_birth',
        'identification_number',
        'nequi_account',
        'status',
    ];

    protected $auditExclude = [
        'password',
        'google_id',
        'agreement_terms',
        'accepted_privacy_policy',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'phone_number',
        'date_of_birth',
        'identification_number',
        'agreement_terms',
        'accepted_privacy_policy',
        'nequi_account',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_of_birth' => 'date',
            'agreement_terms' => 'boolean',
            'accepted_privacy_policy' => 'boolean',
            'status' => 'boolean',
        ];
    }


    public function raffles():HasMany
    {
        return $this->hasMany(Raffle::class);
    }

    public function purchases():HasMany
    {
        return $this->hasMany(Purchase::class);
    }
}
