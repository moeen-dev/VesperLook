<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * 
     * @var arry<int, string>
     */
    protected $fillable = [
        'name',
        'title',
        'image',
        'user_id',
        'product_id',
        'quantity',
        'size',
        'color',
        'price',
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
