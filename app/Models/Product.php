<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'gender',
        'category',
        'subcategory',
        'price',
        'discount',
        'image1',
        'image2',
        'image3',
        'description'
    ];
}
