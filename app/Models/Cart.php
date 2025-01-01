<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        "user_id",
        "product_id",
        "quantity"
    ] ;

    /**
     * Relasi ke tabel users.
     * Banyak entri cart dimiliki oleh satu user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke tabel products.
     * Banyak entri cart merujuk ke satu produk.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
