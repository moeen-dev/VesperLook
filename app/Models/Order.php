<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * 
     * @var arry<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'city',
        'shipping_address',
        'billing_address',
        'order_note',
        'subtotal',
        'shipping_cost',
        'discount',
        'total',
        'delivery_status',
        'payment_method',
    ];

    public function items()
    {
        return $this->hasMany('App\Models\OrderItem', 'order_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
