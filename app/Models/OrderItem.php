<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'size',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected static function booted()
    {
        static::saved(function ($item) {
            self::recalculateOrderTotal($item->order_id);
        });

        static::deleted(function ($item) {
            self::recalculateOrderTotal($item->order_id);
        });
    }

    private static function recalculateOrderTotal($orderId)
    {
        $order = Order::find($orderId);

        if (!$order) return;

        $total = self::where('order_id', $orderId)
            ->get()
            ->sum(function ($item) {
                return $item->price * $item->quantity;
            });

        $order->updateQuietly([
            'total_price' => $total,
        ]);
    }
}