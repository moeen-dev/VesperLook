<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * 
     * @var arry<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'sku',
        'sub_category_id',
        'price',
        'sizes',
        'colors',
        'description',
        'additional_info',
        'reviews',
        'image1',
        'image2',
        'image3',
        'image4',
        'is_new',
        'quantity',
    ];

    protected $casts = [
        'sizes' => 'array',
        'colors' => 'array',
    ];

    public function subCategory()
    {
        return $this->belongsTo('App\Models\SubCategory', 'sub_category_id');
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->sku)) {
                $product->sku = self::generateUniqueSku();
            }
        });
    }

    /**
     * Generate a unique SKU
     */
    public static function generateUniqueSku()
    {
        do {
            $sku = 'PRD-' . now()->format('dmy') . '-' . strtoupper(Str::random(5));
        } while (self::where('sku', $sku)->exists());

        return $sku;
    }

    // app/Models/Product.php

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
