<?php

namespace GameReel\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function clips()
    {
        return $this->hasMany(Clip::class);
    }

    protected $fillable = [
        'gamertag', 'email', 'password', 'xuid',
    ];

    protected $hidden = [
        'password', 'remember_token', 'confirmation_token'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->confirmation_token = str_limit(md5($user->email . str_random()), 32, '');
        });
    }
}
