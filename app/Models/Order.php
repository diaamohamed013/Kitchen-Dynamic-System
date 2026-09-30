<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number', 'customer_name', 'customer_phone', 'order_type', 
        'table_number', 'total_amount', 'payment_status', 'payment_method', 'notes'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function kitchenTicket()
    {
        return $this->hasOne(KitchenTicket::class);
    }
}
