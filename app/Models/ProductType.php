<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class ProductType extends Model
{
    use HasFactory;

    private static $slugTypes = [];

    public function categories()
    {
        return $this->hasMany(ProductCategory::class)->get();
    }

    public function deleteImage()
    {
        $path = public_path(Storage::url($this->image));
        if (file_exists($path)) {
            unlink($path);
        };
    }

    public function slug()
    {
        $slug = strtolower(str_replace(' ', '-', trim($this->name)));
        $slug = preg_replace("/[^a-z0-9-]/", '', $slug);
        $slug = preg_replace("/-+/", '-', $slug);
        $slug = trim($slug, '-');
        return $slug;
    }

    public static function allOrdered()
    {
        return self::orderByDesc('created_at')->get();
    }

    private static function slugInit()
    {
        foreach (self::all() as $type) {
            self::$slugTypes[$type->slug()] = $type;
        }
    }

    public static function findBySlug($slug)
    {
        if (empty(self::$slugTypes)) {
            self::slugInit();
        }

        if (array_key_exists($slug, self::$slugTypes)) {
            return self::$slugTypes[$slug];
        }
        abort('404');
    }

    protected $fillable = [
        "name",
        "image",
    ];
}
