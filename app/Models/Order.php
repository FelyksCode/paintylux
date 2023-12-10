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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
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

    public static function confirmed()
    {
        return self::where('confirmed', true)->orderByDesc('confirmed_at');
    }

    public static function ongoing()
    {
        return self::confirmed()->where('finished', false)->get();
    }

    public static function finished()
    {
        return self::confirmed()->where('finished', true)->get();
    }

    public static function allEarnings()
    {
        $subtotals = self::confirmed()->get()
            ->map(fn ($order) => $order->totalSum());
        return $subtotals->sum();
    }

    public static function ongoingEarnings()
    {
        $subtotals = self::ongoing()
            ->map(fn ($order) => $order->totalSum());
        return $subtotals->sum();
    }

    public static function finishedEarnings()
    {
        $subtotals = self::finished()
            ->map(fn ($order) => $order->totalSum());
        return $subtotals->sum();
    }
    public static function allQuantity()
    {
        $subtotals = self::confirmed()->get()
            ->map(fn ($order) => $order->totalQuantity());
        return $subtotals->sum();
    }

    public static function ongoingQuantity()
    {
        $subtotals = self::ongoing()
            ->map(fn ($order) => $order->totalQuantity());
        return $subtotals->sum();
    }

    public static function finishedQuantity()
    {
        $subtotals = self::finished()
            ->map(fn ($order) => $order->totalQuantity());
        return $subtotals->sum();
    }
    public static function allWeights()
    {
        $subtotals = self::confirmed()->get()
            ->map(fn ($order) => $order->totalWeight());
        return $subtotals->sum();
    }

    public static function ongoingWeights()
    {
        $subtotals = self::ongoing()
            ->map(fn ($order) => $order->totalWeight());
        return $subtotals->sum();
    }

    public static function finishedWeights()
    {
        $subtotals = self::finished()
            ->map(fn ($order) => $order->totalWeight());
        return $subtotals->sum();
    }


    protected $fillable = ['user_id', 'confirmed', 'finished', 'confirmed_at', 'finished_at'];
}
