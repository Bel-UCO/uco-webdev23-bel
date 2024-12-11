<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'gender',
        'category_id',
        'subcategory',
        'price',
        'discount',
        'image1',
        'image2',
        'image3',
        'description'
    ];

        // Product.php
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
