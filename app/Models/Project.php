<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    use HasFactory;

    public function deleteImage()
    {
        $path = public_path(Storage::url($this->image));
        if (file_exists($path)) {
            unlink($path);
        };
    }

    public static function allOrdered()
    {
        return self::orderByDesc('year')->orderBy('name')->get();
    }

    protected $fillable = [
        'name',
        'year',
        'description',
        'image',
    ];
}
