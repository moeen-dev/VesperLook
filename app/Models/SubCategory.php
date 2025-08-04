<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * 
     * @var arry<int, string>
     */
    protected $fillable = [
        'subcategory_name',
        'slug',
        'image',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'sub_category_id');
    }
}
