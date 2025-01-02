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

     /**
     * Relasi ke tabel carts (satu produk bisa ada di banyak cart).
     */
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function checkoutLists()
    {
        return $this->hasMany(CheckoutList::class, 'product_id');
    }


}
