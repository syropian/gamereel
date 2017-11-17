<?php

namespace GameReel\Models;

use Illuminate\Support\Carbon;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $casts = [
        'confirmed' => 'boolean'
    ];

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

    public function confirm()
    {
        $this->confirmed = true;
        $this->confirmation_token = null;
        $this->save();
    }

    public function confirmationPassedDue()
    {
        return !$this->confirmed && Carbon::now()->diffInDays($this->created_at) >= 3;
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
