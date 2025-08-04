<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * 
     * @var arry<int, string>
     */
    protected $fillable = [
        'category_name',
        'slug',
        'image',
    ];

    public function subcategories()
    {
        return $this->hasMany('App\Models\SubCategory', 'category_id');
    }
}
