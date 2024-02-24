<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    public const LOGIN_ATTEMP_LIMITATION = 5;

    protected $fillable = [
        'uuid',
        'name',
        'email',
        'password',
        'block_until',
        'number_of_attemp',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'block_until' => 'datetime',
        'email_verified_at' => 'datetime',
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function isBlocked(): bool
    {
        if (is_null($this->block_until)) {
            return false;
        }

        return now()->lt(Carbon::parse($this->block_until));
    }
}
