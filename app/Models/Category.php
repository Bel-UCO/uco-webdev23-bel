<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        "name",
        "order_no",
        "image"
    ] ;

    public static function getOrdered()
    {
        return self::orderBy('order_no')->orderBy('name')->get();
    }

    // Category.php
    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
