<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckoutList extends Model
{
    protected $fillable = [
        'checkout_id',
        'product_id',
        'quantity'
    ];

    public function checkout()
    {
        return $this->belongsTo(Checkout::class, 'checkout_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
