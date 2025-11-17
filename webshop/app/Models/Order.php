<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_phone',
        'billing_address',
        'billing_city',
        'billing_zip',
        'shipping_address',
        'shipping_city',
        'shipping_zip',
        'shipping_method',
        'payment_method',
        'total_amount',
        'items',
        'status'
    ];

    protected $casts = [
        'items' => 'array'
    ];
}
