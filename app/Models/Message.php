<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public function markAsRead()
    {
        $this->read = true;
        $this->save();
    }

    public static function allOrdered()
    {
        return self::orderByDesc('created_at')->get();
    }

    public static function read()
    {
        return self::orderByDesc('created_at')->where('read', true)->get();
    }

    public static function notRead()
    {
        return self::orderByDesc('created_at')->where('read', false)->get();
    }

    protected $fillable = [
        'sender',
        'contact',
        'location',
        'content',
    ];
}
