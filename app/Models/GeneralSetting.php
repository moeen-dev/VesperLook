<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass asiignable.
     * 
     * @var arry<int, string>
     */
    protected $fillable = [
        'phone_number',
        'email',
        'facebook_url',
        'instagram_url',
        'linkedin_url',
        'pinterest_url',
    ];
}
