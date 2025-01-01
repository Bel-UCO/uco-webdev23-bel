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

    public function update(Request $request)
    {

        dd($request->all());

        $request->validate([
            'id' => 'required|exists:carts,id',
            'quantity' => 'required|integer|min:0', // Izinkan 0 untuk menghapus
        ]);

        $cartItem = Cart::findOrFail($request->id);

        if ($request->quantity == 0) {
            // Hapus jika quantity = 0
            $cartItem->delete();

            return redirect()->route('cart.list')->with('success', 'Item removed from cart.');
        }

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return redirect()->route('cart.list')->with('success', 'Quantity updated successfully.');
    }



    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:carts,id',
        ]);

        $cartItem = Cart::findOrFail($request->id);
        $cartItem->delete();

        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();

        return view('cart.list', compact('cartItems'));
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*' => 'exists:carts,id',
        ]);

        $userId = Auth::id();
        $cartItems = Cart::whereIn('id', $request->items)->where('user_id', $userId)->get();

        // Lakukan proses checkout
        return view('cart.checkout', compact('cartItems'));
    }


};
