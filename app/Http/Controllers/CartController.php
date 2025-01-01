<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index() {
        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();

        return view('cart.index', compact('cartItems'));
    }
};
