<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    protected $fillable = [
        'user_id',
        'receiver',
        'phone',
        'address',
        'status',
        'payment_method',
        'paid_price'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function checkoutLists()
    {
        return $this->hasMany(CheckoutList::class, 'checkout_id');
    }

}
