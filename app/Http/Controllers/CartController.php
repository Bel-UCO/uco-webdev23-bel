<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Checkout;
use App\Models\CheckoutList;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index() {
        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();

        return view('cart.index', compact('cartItems'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $userId = Auth::id();

        // Periksa apakah produk sudah ada di keranjang
        $cartItem = Cart::where('user_id', $userId)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            // Jika produk sudah ada, tambahkan quantity
            $cartItem->quantity = $cartItem->quantity + 1;
            $cartItem->save();
        } else {
            // Jika produk belum ada, tambahkan ke keranjang
            Cart::create([
                'user_id' => $userId,
                'product_id' => $request->product_id,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
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

            // Jika permintaan AJAX
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Quantity updated successfully.',
                ]);
            }

            return redirect()->route('cart.list')->with('success', 'Cart updated successfully.');
        }

        return redirect()->route('cart.list')->with('error', 'No action performed.');
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

    public function payment(Request $request)
    {
        // Validasi input
        $request->validate([
            'receiver' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'payment_method' => 'required|string|in:bank_transfer,credit_card,cash_on_delivery',
        ]);

        // Ambil data dari session (atau metode lain sesuai implementasi Anda)
        $checkoutItems = session('checkoutItems', collect());
        if ($checkoutItems->isEmpty()) {
            return redirect()->route('cart.list')->with('error', 'No items to checkout.');
        }

        // Simpan data ke tabel checkout
        $checkout = Checkout::create([
            'user_id' => Auth::id(),
            'receiver' => $request->receiver,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => 'paid',
            'payment_method' => $request->payment_method,
            'paid_price' => $checkoutItems->sum(function ($item) {
                $priceAfterDiscount = $item->product->price - ($item->product->price * $item->product->discount / 100);
                return $priceAfterDiscount * $item->quantity;
            }) + 2000 + 16000, // Total + Admin Fee + Delivery Fee
        ]);

        // Simpan item ke tabel checkout_lists
        foreach ($checkoutItems as $item) {
            CheckoutList::create([
                'checkout_id' => $checkout->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
            ]);
        }

        // Hapus barang dari tabel cart
        Cart::whereIn('id', $checkoutItems->pluck('id'))->delete();

        // Redirect ke halaman sukses atau pembayaran
        return redirect()->route('cart.succeed')->with('success', 'Checkout completed. Proceed to payment.');
    }




};
