<x-template title="Checkout">
    <div>
        <h1>Checkout</h1>
    </div>

    @if ($checkoutItems->isEmpty())
        <div style="display:flex; align-items:center; justify-content:center; height:400px">
            <p>No items to checkout.</p>
        </div>
    @else
        <!-- Form Checkout -->
        <form method="POST" action="{{ route('cart.payment') }}">
            @csrf

            <!-- Informasi Pembeli -->
            <div class="mb-4">
                <h4>Billing Information</h4>
                <div class="form-group mb-3">
                    <label for="receiver">Name</label>
                    <input type="text" name="receiver" id="receiver" class="form-control" placeholder="Receiver Name" required>
                </div>
                <div class="form-group mb-3">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone Number" required>
                </div>
                <div class="form-group mb-3">
                    <label for="address">Address</label>
                    <textarea name="address" id="address" class="form-control" placeholder="Complete Address" rows="3" required></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="payment_method">Payment Method</label>
                    <div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="bank_transfer" value="bank_transfer" required>
                            <label class="form-check-label" for="bank_transfer">
                                Bank Transfer
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="credit_card" value="credit_card">
                            <label class="form-check-label" for="credit_card">
                                Credit Card
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="cash_on_delivery" value="cash_on_delivery">
                            <label class="form-check-label" for="cash_on_delivery">
                                Cash on Delivery
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daftar Produk -->
            <div class="mb-4">
                <h4>Order Summary</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $grandTotal = 0; @endphp
                        @foreach($checkoutItems as $item)
                            @php
                                $priceAfterDiscount = $item->product->price - ($item->product->price * $item->product->discount / 100);
                                $itemTotal = $priceAfterDiscount * $item->quantity;
                                $grandTotal += $itemTotal;
                            @endphp
                            <tr>
                                <td>
                                    <img src="data:image/jpeg;base64,{{ base64_encode($item->product->image1) }}" alt="Product Image" style="width: 50px; height: 50px;" onerror="this.onerror=null;this.src='https://fastly.picsum.photos/id/468/350/350.jpg?hmac=4jGTGKUJEby3tFz0qbVu3WGj1yrH6k2JZVcnjAIkAz0';">
                                </td>
                                <td>{{ $item->product->name }} {{ $item->product->subcategory }}</td>
                                <td>Rp {{ number_format($priceAfterDiscount, 0, '.', '.') }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>Rp {{ number_format($itemTotal, 0, '.', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Total Harga dan Tombol -->
            <div class="mt-4 d-flex justify-content-end align-items-end flex-column" style="text-align: right;">
                <p>Admin Fee: Rp 2.000</p>
                <p>Delivery Fee: Rp 16.000</p>
                <h3>Total: Rp {{ number_format($grandTotal + 2000 + 16000, 0, '.', '.') }}</h3>
                <button type="submit" class="btn btn-primary mt-3">Proceed to Payment</button>
            </div>
        </form>
    @endif
</x-template>
