<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * 
     * @var arry<int, string>
     */
    protected $fillable = [
        'page_type',
        'reference_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'reference_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'reference_id');
    }
}
