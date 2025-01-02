<x-template title="Checkout">
    <div>
        <h1>Checkout</h1>
    </div>

    @if ($checkoutItems->isEmpty())
        <div style="display:flex; align-items:center; justify-content:center; height:400px">
            <p>No item to checkout.</p>
        </div>
    @else
        <div class="mt-4">
            <!-- Daftar Barang -->
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th style="width: 10%;">Image</th>
                        <th style="width: 40%;">Product</th>
                        <th style="width: 20%;">Price</th>
                        <th style="width: 10%;">Quantity</th>
                        <th style="width: 20%;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $grandTotal = 0;
                        $adminFee = 2000;
                        $deliveryFee = 16000;
                    @endphp

                    @foreach($checkoutItems as $item)
                        @php
                            $priceAfterDiscount = $item->product->price - ($item->product->price * $item->product->discount / 100);
                            $itemTotal = $priceAfterDiscount * $item->quantity;
                            $grandTotal += $itemTotal;
                        @endphp
                        <tr>
                            <td>
                                <img src="data:image/jpeg;base64,{{ base64_encode($item->product->image1) }}" alt="Product Image" class="product-image">
                            </td>
                            <td>
                                {{ $item->product->name }} {{ $item->product->subcategory }}
                            </td>
                            <td>
                                Rp {{ number_format($priceAfterDiscount, 0, '.', '.') }}
                            </td>
                            <td>
                                {{ $item->quantity }}
                            </td>
                            <td>
                                Rp {{ number_format($itemTotal, 0, '.', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Admin and Delivery Fee -->
            <div class="mt-4">
                <p>Admin Fee: Rp {{ number_format($adminFee, 0, '.', '.') }}</p>
                <p>Delivery Fee: Rp {{ number_format($deliveryFee, 0, '.', '.') }}</p>
            </div>

            <!-- Total Harga Keseluruhan -->
            @php
                $grandTotal += $adminFee + $deliveryFee;
            @endphp
            <div class="d-flex align-items-center justify-content-between mt-4">
                <h3>Total: Rp {{ number_format($grandTotal, 0, '.', '.') }}</h3>
            </div>

            <!-- Button Lanjut ke Payment -->
            <form method="POST" action="{{ route('cart.payment') }}">
                @csrf
                <input type="hidden" name="grandTotal" value="{{ $grandTotal }}">
                <input type="hidden" name="checkoutItems" value="{{ json_encode($checkoutItems) }}">
                <button type="submit" class="btn btn-primary mt-3">Proceed to Payment</button>
            </form>
        </div>
    @endif
</x-template>
