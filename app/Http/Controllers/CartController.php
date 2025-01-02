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
        $request->validate([
            'items' => 'nullable|array',
            'quantity' => 'nullable|array',
            'action' => 'nullable|string',
        ]);

        // Tangani aksi berdasarkan tombol yang diklik
        if ($request->has('action')) {
            $action = $request->input('action');

            if ($action === 'checkout') {
                // Lanjutkan ke checkout
                $selectedItems = $request->input('items', []);
                if (empty($selectedItems)) {
                    return redirect()->route('cart.list')->with('error', 'Please select items to checkout.');
                }

                $cartItems = Cart::whereIn('id', $selectedItems)->get();

                // Simpan data ke session
                session(['checkoutItems' => $cartItems]);

                // Redirect ke halaman checkout
                return redirect()->route('cart.checkout');
            }


            // Tangani aksi lain (increment, decrement, delete)
            [$actionType, $itemId] = explode('-', $action);

            $cartItem = Cart::findOrFail($itemId);

            if ($actionType === 'decrement') {
                // Kurangi quantity
                $cartItem->quantity = max(1, $cartItem->quantity - 1);
                $cartItem->save();
            } elseif ($actionType === 'increment') {
                // Tambah quantity
                $cartItem->quantity += 1;
                $cartItem->save();
            } elseif ($actionType === 'delete') {
                // Hapus item
                $cartItem->delete();
            }

            return redirect()->route('cart.list')->with('success', 'Cart updated successfully.');
        }

        // Tangani perubahan quantity manual
        if ($request->has('quantity')) {
            foreach ($request->input('quantity') as $itemId => $quantity) {
                $cartItem = Cart::findOrFail($itemId);
                $cartItem->quantity = max(1, intval($quantity));
                $cartItem->save();
            }
        }

        return redirect()->route('cart.list')->with('success', 'Cart updated successfully.');
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

    public function checkout()
    {
        // Ambil data dari session
        $checkoutItems = session('checkoutItems', collect()); // Default ke koleksi kosong jika tidak ada

        if ($checkoutItems->isEmpty()) {
            return redirect()->route('cart.list')->with('error', 'No items to checkout.');
        }

        // Render halaman checkout
        return view('cart.checkout', compact('checkoutItems'));
    }



};
