<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class ProductType extends Model
{
    use HasFactory;

    public function deleteImage()
    {
        $path = public_path(Storage::url($this->image));
        if (file_exists($path)) {
            unlink($path);
        };
    }
    protected $fillable = [
        "name",
        "image",
    ];
}
