<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;

class Order extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_phone',
        'customer_email',
        'pickup_branch',
        'notes',
        'status',
        'total_price',
    ];

    /**
     * Relación: un pedido tiene muchos items
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Lógica automática del modelo
     */
    protected static function booted()
    {
        /**
         * ANTES de crear → evitar nulls
         */
        static::creating(function ($order) {

            // Evita error de total_price null
            if (is_null($order->total_price)) {
                $order->total_price = 0;
            }

            // Evita error de status null
            if (is_null($order->status)) {
                $order->status = 'pending';
            }
        });

        /**
         * DESPUÉS de guardar → recalcular total
         */
        static::saved(function ($order) {

            $total = OrderItem::where('order_id', $order->id)
                ->get()
                ->sum(function ($item) {
                    return $item->price * $item->quantity;
                });

            $order->updateQuietly([
                'total_price' => $total,
            ]);
        });
    }
}