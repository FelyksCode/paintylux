<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    public function type()
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

    public function name()
    {
        return "{$this->type->name} $this->container $this->weight kg";
    }

    public static function allOrdered()
    {
        return self::orderBy('product_type_id')->get();
    }

    protected $fillable = [
        "price",
        "weight",
        "container",
        "product_type_id",
    ];
}
