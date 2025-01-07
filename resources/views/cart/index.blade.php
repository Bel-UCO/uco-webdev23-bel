
<x-template title="Cart">
    <div>
        <h1>Cart</h1>
    </div>
    @if ($cartItems->isEmpty())
        <div style="display:flex; align-items:center; justify-content:center; height:400px">
            <p>Your cart is empty. Add some products!</p>
        </div>
    @else
        <!-- Form untuk Semua Aksi -->
        <form action="{{ route('cart.update') }}" id="cart-form" method="POST">
            @csrf

            <!-- Checklist All -->
            <div class="mb-3">
                <input id="check-all" type="checkbox"> Select All
            </div>

            <!-- Cart Table -->
            <div style="overflow-x: auto;">
                <table class="custom-table table" id="cart-table">
                    <thead>
                        <tr>
                            <th style="width: 10%;">Check</th>
                            <th style="width: 40%;">Product</th>
                            <th style="width: 20%;">Price</th>
                            <th style="width: 20%;">Quantity</th>
                            <th style="width: 10%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $item)
                            @php
                                $priceAfterDiscount = $item->product->price - ($item->product->price * $item->product->discount) / 100;
                            @endphp
                            <tr data-id="{{ $item->id }}" data-price="{{ $priceAfterDiscount }}">
                                <!-- Checklist -->
                                <td class="text-center align-middle">
                                    <input class="check-item" name="items[]" type="checkbox" value="{{ $item->id }}">
                                </td>

                                <!-- Product Name and Image -->
                                <td class="align-middle">
                                    <a class="product-link d-flex align-items-center" href="{{ route('products.show', $item->product->id) }}">
                                        <img alt="Product Image" class="product-image me-2" src="data:image/jpeg;base64,{{ base64_encode($item->product->image1) }}">
                                        <span>{{ $item->product->name }} {{ $item->product->subcategory }}</span>
                                    </a>
                                </td>

                                <!-- Price -->
                                <td class="text-center align-middle">
                                    <p class="price mb-0" id="price-{{ $item->id }}">
                                        Rp {{ number_format($priceAfterDiscount * $item->quantity, 0, '.', '.') }}
                                    </p>
                                </td>

                                <!-- Quantity -->
                                <td class="align-middle">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <button {{ $item->quantity == 1 ? 'disabled' : '' }} class="btn btn-secondary btn-sm quantity-btn" onclick="decrementQuantity({{ $item->id }}, this, {{ $item->normal_price }})" type="button"
                                            value="decrement-{{ $item->id }}">-</button>
                                        <input
                                            class="form-control form-control-sm quantity-input text-center" data-id="{{ $item->id }}" min="1" name="quantity[{{ $item->id }}]"
                                            onchange="updateQuantity(this, {{ $item->normal_price }})" style="width: 60px;" type="number" value="{{ $item->quantity }}">
                                        <button class="btn btn-secondary btn-sm quantity-btn" onclick="incrementQuantity({{ $item->id }}, this, {{ $item->normal_price }})" type="button"
                                            value="increment-{{ $item->id }}">+</button>
                                    </div>
                                </td>

                                <!-- Actions -->
                                <td class="text-center align-middle">
                                    <button class="btn btn-danger btn-sm" name="action" type="submit" value="delete-{{ $item->id }}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Subtotal -->
            <div class="d-flex align-items-center justify-content-between mt-4">
                <!-- Subtotal -->
                <h3 class="mb-0" id="subtotal">Subtotal: Rp 0</h3>

                <!-- Button Checkout -->
                <button class="btn btn-primary" name="action" type="submit" value="checkout">Proceed to Checkout</button>
            </div>

        </form>
    @endif

    <style>
        .custom-table {
            width: 100%;
            border-collapse: collapse;
        }

        .custom-table th,
        .custom-table td {
            vertical-align: middle;
            text-align: center;
            padding: 10px;
            height: 70px;
            /* Tinggi tetap */
        }

        .custom-table tbody tr {
            border-bottom: 1px solid #ddd;
        }

        .product-link {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: inherit;
        }

        .product-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
        }

        .quantity-cell {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .quantity-input {
            width: 60px;
            text-align: center;
        }

        .quantity-btn {
            width: 30px;
            height: 30px;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .btn-sm {
            font-size: 0.875rem;
        }
    </style>


    <script>
        const updateQuantity = (inputElement, normalPrice) => {
            const cartItemId = inputElement.dataset.id;
            const newQuantity = parseInt(inputElement.value);

            if (newQuantity < 1) {
                alert('Quantity must be at least 1.');
                inputElement.value = 1;
                return;
            }

            const decrementButton = inputElement.previousElementSibling;
            decrementButton.disabled = newQuantity <= 1;

            updateQuantityOnServer(cartItemId, newQuantity, normalPrice);
            updatePrice(cartItemId, normalPrice, newQuantity);
        };

        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    this.blur();
                }
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            const checkAll = document.getElementById('check-all');
            const checkItems = document.querySelectorAll('.check-item');
            const subtotalElement = document.getElementById('subtotal');

            const formatRupiah = number =>
                `Rp ${number.toLocaleString('id-ID', { useGrouping: true }).replace(/,/g, '.')}`;

            const calculateSubtotal = () => {
                const subtotal = [...checkItems].reduce((total, item) => {
                    if (item.checked) {
                        const row = item.closest('tr');
                        const price = parseFloat(row.dataset.price);
                        const quantity = parseInt(row.querySelector('.quantity-input').value);
                        return total + (price * quantity);
                    }
                    return total;
                }, 0);

                subtotalElement.textContent = `Subtotal: ${formatRupiah(subtotal)}`;
            };

            checkAll.addEventListener('change', () => {
                checkItems.forEach(item => item.checked = checkAll.checked);
                calculateSubtotal();
            });

            checkItems.forEach(item =>
                item.addEventListener('change', calculateSubtotal)
            );

            calculateSubtotal();
        });

        const decrementQuantity = (cartItemId, buttonElement, normalPrice) => {
            const inputElement = buttonElement.nextElementSibling;
            const currentQuantity = parseInt(inputElement.value);

            if (currentQuantity > 1) {
                const newQuantity = currentQuantity - 1;
                inputElement.value = newQuantity;
                buttonElement.disabled = newQuantity <= 1;

                updateQuantityOnServer(cartItemId, newQuantity, normalPrice);
                updatePrice(cartItemId, normalPrice, newQuantity);
            }
        };

        const incrementQuantity = (cartItemId, buttonElement, normalPrice) => {
            const inputElement = buttonElement.previousElementSibling;
            const newQuantity = parseInt(inputElement.value) + 1;

            inputElement.value = newQuantity;
            inputElement.previousElementSibling.disabled = false;

            updateQuantityOnServer(cartItemId, newQuantity, normalPrice);
            updatePrice(cartItemId, normalPrice, newQuantity);
        };

        const updateQuantityOnServer = async (cartItemId, newQuantity, normalPrice) => {
            const actionUrl = "{{ route('cart.updateQuantity') }}";
            const csrfToken = "{{ csrf_token() }}";

            try {
                const response = await fetch(actionUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        quantity: {
                            [cartItemId]: newQuantity
                        }
                    })
                });

                const data = await response.json();

                if (!data.success) {
                    throw new Error(data.message || 'Failed to update cart.');
                }
            } catch (error) {
                console.error('Error:', error);
                const input = document.querySelector(`input[data-id="${cartItemId}"]`);
                input.value = input.defaultValue;
                alert(error.message);
            }
        };

        const updatePrice = (cartItemId, pricePerItem, quantity) => {
            const priceElement = document.getElementById(`price-${cartItemId}`);
            const totalPrice = pricePerItem * quantity;

            const formattedPrice = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(totalPrice).replace('IDR', 'Rp');

            priceElement.textContent = formattedPrice;
            calculateSubtotal();
        };

        const calculateSubtotal = () => {
            const checkItems = document.querySelectorAll('.check-item');
            const subtotalElement = document.getElementById('subtotal');

            const subtotal = [...checkItems].reduce((total, item) => {
                if (item.checked) {
                    const row = item.closest('tr');
                    const price = parseFloat(row.dataset.price);
                    const quantity = parseInt(row.querySelector('.quantity-input').value);
                    return total + (price * quantity);
                }
                return total;
            }, 0);

            subtotalElement.textContent = `Subtotal: ${formatRupiah(Math.round(subtotal))}`;
        };

        const formatRupiah = number =>
            `Rp ${number.toLocaleString('id-ID', { useGrouping: true }).replace(/,/g, '.')}`;
    </script>
</x-template>
