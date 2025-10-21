<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivacyPolicy extends Model
{
    use HasFactory;
    /**
     * The arrtibutes that are mass assignable.
     * 
     * @var arry<ing, string>
     */

    protected $fillable = [
        "privacy_policy",
    ];
}
