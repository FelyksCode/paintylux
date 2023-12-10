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

    public function activeOrder()
    {
        return $this->orders()->firstWhere('confirmed', false);
    }

    public function cartQuantity($minified = false)
    {
        $activeOrder = $this->activeOrder();
        return $activeOrder ? $activeOrder->totalQuantity($minified) : 0;
    }

    public function confirmedOrders()
    {
        return $this->orders()->where('confirmed', true)->orderByDesc('confirmed_at');
    }

    public function ongoingOrders()
    {
        return $this->confirmedOrders()->where('finished', false);
    }

    public function finishedOrders()
    {
        return $this->confirmedOrders()->where('finished', true);
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
