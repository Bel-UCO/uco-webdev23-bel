<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function addToFavorites($productId)
    {
        $user = Auth::user();

        // Periksa apakah sudah ada di favorites
        $exists = Favorite::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->exists();

        if (!$exists) {
            Favorite::create([
                'user_id' => $user->id,
                'product_id' => $productId,
            ]);

            return redirect()->back()->with('success', 'Added to favorites');
        }

        return redirect()->back()->with('info', 'Already in favorites');
    }

    public function removeFromFavorites($productId)
    {
        $user = Auth::user();

        Favorite::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->delete();

        return redirect()->back()->with('success', 'Removed from favorites');
    }

    public function viewFavorites()
    {
        $userId = Auth::id();

        // Query menggunakan Eloquent dengan `with` untuk memuat relasi
        $favorites = Favorite::with(['product.category']) // Include relasi product dan category
            ->where('user_id', $userId) // Filter berdasarkan user yang sedang login
            ->get();

        return view('products.favorites', compact('favorites'));
    }

}
