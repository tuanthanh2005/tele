<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_code',
        'product_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'amount',
        'payment_method',
        'payment_status',
        'payment_proof',
        'paid_at',
        'download_sent'
    ];

    protected $casts = [
        'amount' => 'decimal:0',
        'paid_at' => 'datetime',
        'download_sent' => 'boolean'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
