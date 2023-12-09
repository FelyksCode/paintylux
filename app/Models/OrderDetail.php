<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class OrderDetail extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function name()
    {
        return "{$this->color->name} {$this->category->name()}";
    }

    public function subtotal()
    {
        return $this->quantity * $this->category->price;
    }

    public function totalWeight()
    {
        return $this->quantity * $this->category->weight;
    }

    public static function addOrder($quantity, $product_category_id, $color_id)
    {
        // Do nothing if not logged in
        if (!Auth::check()) {
            return;
        }

        // Get active order or create new order if there isn't one
        $order = Auth::user()->activeOrder();
        if (!$order) {
            $order = Order::create(['user_id' => Auth::user()->id]);
        }

        // Find if an order detail of the same product type and color has been made
        $orderDetail = self::where('order_id', $order->id)
            ->where('product_category_id', $product_category_id)
            ->where('color_id', $color_id)
            ->first();

        // Create new one if not found, otherwise add quantity to existing one
        if (!$orderDetail) {
            $orderDetail = self::create([
                'order_id' => $order->id,
                'quantity' => $quantity,
                'product_category_id' => $product_category_id,
                'color_id' => $color_id,
            ]);
        } else {
            $orderDetail->update(['quantity' => $orderDetail->quantity + $quantity]);
        }
    }

    protected $fillable = [
        "quantity",
        "order_id",
        "product_category_id",
        "color_id",
    ];
}
