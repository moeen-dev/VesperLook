<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentPolicy extends Model
{
    use HasFactory;

    /**
     * The attribute that are the mass assignable.
     * 
     * @var arry<int, string>
     */
    protected $fillable = [
        'payment_policy',
    ];
}
