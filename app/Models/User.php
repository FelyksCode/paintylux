<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function ongoingOrders()
    {
        return $this->orders()->where('finished', false);
    }

    public function finishedOrders()
    {
        return $this->orders()->where('finished', true);
    }

    public static function allOrdered()
    {
        return self::orderByDesc('created_at')->get();
    }

    public static function nonAdmins()
    {
        return self::orderByDesc('created_at')->where('is_admin', false)->get();
    }

    public static function admins()
    {
        return self::orderByDesc('created_at')->where('is_admin', true)->get();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $attributes = [
        "is_admin" => false,
    ];
}
