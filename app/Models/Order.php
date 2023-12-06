<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    static function ongoing()
    {
        return self::where('finished', false)->get();
    }

    static function finished()
    {
        return self::where('finished', true)->get();
    }

    protected $fillable = ['user_id'];
}
