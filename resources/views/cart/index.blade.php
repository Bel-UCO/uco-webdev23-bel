<x-template title="Cart">
    <div>
        <h1>Cart</h1>
    </div>
    @if ($cartItems->isEmpty())
        <div style="display:flex; align-items:center; justify-content:center; height:400px">
            <p>Add product to your cart.</p>
        </div>
    @else
        <!-- Form untuk checklist dan checkout -->
        <form method="POST" action="{{ route('cart.checkout') }}" id="checkout-form">
            @csrf

            <!-- Checklist All -->
            <div class="mb-3">
                <input type="checkbox" id="check-all"> Select All
            </div>

            <!-- Cart Table -->
            <div style="overflow-x: auto;">
                <table class="table table-fixed" id="cart-table" style="width: 100%; table-layout: fixed;">
                    <thead>
                        <tr>
                            <th style="width: 10%;">Check</th>
                            <th style="width: 40%;">Product</th>
                            <th style="width: 20%;">Price</th>
                            <th style="width: 30%;">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $item)
                            <tr data-id="{{ $item->id }}" data-price="{{ $item->product->price }}">
                                <td>
                                    <input type="checkbox" name="items[]" value="{{ $item->id }}" class="check-item">
                                </td>
                                <td>
                                    <a href="{{ route('products.show', $item->product->id) }}" style="display: flex; align-items: center; text-decoration: none; color: inherit;">
                                        <img src="data:image/jpeg;base64,{{ base64_encode($item->product->image1) }}" alt="Product Image" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">
                                        <span>{{ $item->product->name }}</span>
                                    </a>
                                </td>
                                <td>
                                    <p class="price" data-original-price="{{ $item->product->price }}">
                                        Rp {{ number_format($item->product->price * $item->quantity, 0, '.', '.') }}
                                    </p>
                                </td>
                                <td style="display: flex; align-items: center;">
                                    <!-- Tombol Minus -->



                                    <form action="{{ route('cart.update') }}" method="POST" style="margin-right: 5px;" onsubmit="console.log('Form Submitted'); return true;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
                                        <button type="submit" class="btn btn-secondary decrement-btn">-</button>
                                    </form>




                                    <!-- Input Manual Quantity -->
                                    <form action="{{ route('cart.update') }}" method="POST" style="margin: 0 10px;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <input type="number" name="quantity" class="form-control update-quantity" value="{{ $item->quantity }}" min="1" style="width: 60px; text-align: center;" onchange="this.form.submit()">
                                    </form>

                                    <!-- Tombol Plus -->
                                    <form action="{{ route('cart.update') }}" method="POST" style="margin-right: 5px;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                        <button type="submit" class="btn btn-secondary increment-btn">+</button>
                                    </form>

                                    <!-- Tombol Delete -->
                                    <form action="{{ route('cart.delete') }}" method="POST" style="margin-left: 10px;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Subtotal -->
            <div class="mt-4">
                <h3 id="subtotal">Subtotal: Rp 0</h3>
            </div>

            <!-- Button Checkout -->
            <button type="submit" class="btn btn-primary mt-3">Proceed to Checkout</button>
        </form>
    @endif
</x-template>
