<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $orderDetails = [];

    public function confirmOrder()
    {
        $this->update(['confirmed' => true, 'confirmed_at' => now()]);
    }

    public function finishOrder()
    {
        $this->update(['finished' => true, 'finished_at' => now()]);
    }

    public function getOrderDetails()
    {
        $this->orderDetails = $this->hasMany(OrderDetail::class)
            ->with('category')
            ->with('color')
            ->orderBy('created_at');
        return $this->orderDetails;
    }

    public function totalQuantity($minified = false)
    {
        if (empty($this->orderDetails)) {
            $this->getOrderDetails();
        }
        $totalQuantity = $this->orderDetails->sum('quantity');
        return ($totalQuantity > 99 && $minified) ? '99+' : (int) $totalQuantity;
    }

    public function totalSum()
    {
        if (empty($this->orderDetails)) {
            $this->getOrderDetails();
        }
        $subtotals = $this->orderDetails->get()
            ->map(fn ($orderDetail) => $orderDetail->subtotal());
        return $subtotals->sum();
    }

    public function totalWeight()
    {
        if (empty($this->orderDetails)) {
            $this->getOrderDetails();
        }
        $weights = $this->orderDetails->get()
            ->map(fn ($orderDetail) => $orderDetail->totalWeight());
        return $weights->sum();
    }

    public static function ongoing()
    {
        return self::where('finished', false)->orderByDesc('confirmed_at')->get();
    }

    public static function finished()
    {
        return self::where('finished', true)->orderByDesc('finished_at')->get();
    }

    protected $fillable = ['user_id', 'confirmed', 'finished', 'confirmed_at', 'finished_at'];
}
