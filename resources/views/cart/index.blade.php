
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
        <form method="POST" action="{{ route('cart.update') }}" id="cart-form">
            @csrf

            <!-- Checklist All -->
            <div class="mb-3">
                <input type="checkbox" id="check-all"> Select All
            </div>

            <!-- Cart Table -->
            <div style="overflow-x: auto;">
                <table class="table custom-table" id="cart-table">
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
                        @foreach($cartItems as $item)
                            @php
                                $priceAfterDiscount = $item->product->price - ($item->product->price * $item->product->discount / 100);
                            @endphp
                            <tr data-id="{{ $item->id }}" data-price="{{ $priceAfterDiscount }}">
                                <!-- Checklist -->
                                <td class="align-middle text-center">
                                    <input type="checkbox" name="items[]" value="{{ $item->id }}" class="check-item">
                                </td>

                                <!-- Product Name and Image -->
                                <td class="align-middle">
                                    <a href="{{ route('products.show', $item->product->id) }}" class="product-link d-flex align-items-center">
                                        <img src="data:image/jpeg;base64,{{ base64_encode($item->product->image1) }}" alt="Product Image" class="product-image me-2">
                                        <span>{{ $item->product->name }} {{ $item->product->subcategory }}</span>
                                    </a>
                                </td>

                                <!-- Price -->
                                <td class="align-middle text-center">
                                    <p class="price mb-0" id="price-{{$item->id}}">
                                        Rp {{ number_format($priceAfterDiscount * $item->quantity, 0, '.', '.') }}
                                    </p>
                                </td>

                                <!-- Quantity -->
                                <td class="align-middle">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <button type="button" onclick="decrementQuantity({{ $item->id }}, this, {{$item->normal_price}})" value="decrement-{{ $item->id }}" class="btn btn-secondary btn-sm quantity-btn"  {{ $item->quantity == 1 ? 'disabled' : '' }}>-</button>
                                        <input
                                            type="number"
                                            name="quantity[{{ $item->id }}]"
                                            value="{{ $item->quantity }}"
                                            min="1"
                                            class="form-control form-control-sm quantity-input text-center"
                                            style="width: 60px;"
                                            data-id="{{ $item->id }}"
                                            onchange="updateQuantity(this, {{$item->normal_price}})">
                                        <button type="button" onclick="incrementQuantity({{ $item->id }}, this, {{$item->normal_price}})" value="increment-{{ $item->id }}" class="btn btn-secondary btn-sm quantity-btn" >+</button>
                                    </div>
                                </td>

                                <!-- Actions -->
                                <td class="align-middle text-center">
                                    <button type="submit" name="action" value="delete-{{ $item->id }}" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Subtotal -->
            <div class="d-flex align-items-center justify-content-between mt-4">
                <!-- Subtotal -->
                <h3 id="subtotal" class="mb-0">Subtotal: Rp 0</h3>

                <!-- Button Checkout -->
                <button type="submit" name="action" value="checkout" class="btn btn-primary">Proceed to Checkout</button>
            </div>

        </form>
    @endif

    <style>
        .custom-table {
            width: 100%;
            border-collapse: collapse;
        }

        .custom-table th, .custom-table td {
            vertical-align: middle;
            text-align: center;
            padding: 10px;
            height: 70px; /* Tinggi tetap */
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
        function updateQuantity(inputElement, normalPrice) {
            console.log(normalPrice);



            const csrfToken = "{{ csrf_token() }}";

            if (quantity < 1) {
                alert('Quantity must be at least 1.');

                return;
            }

            fetch(actionUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({

                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Quantity updated successfully.');
                    updatePrice(cartItemId, normalPrice, inputElement);

                } else {
                    alert(data.message || 'Failed to update cart.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            const checkAll = document.getElementById('check-all');
            const checkItems = document.querySelectorAll('.check-item');
            const subtotalElement = document.getElementById('subtotal');

            function formatRupiah(number) {
                return 'Rp ' + number.toLocaleString('id-ID', { useGrouping: true }).replace(/,/g, '.');
            }

            function calculateSubtotal() {
                let subtotal = 0;
                checkItems.forEach(item => {
                    if (item.checked) {
                        const row = item.closest('tr');
                        const price = parseInt(row.dataset.price, 10);
                        const quantity = parseInt(row.querySelector('.quantity-input').value, 10);
                        subtotal += price * quantity;
                    }
                });
                subtotalElement.textContent = `Subtotal: ${formatRupiah(subtotal)}`;
            }

            checkAll.addEventListener('change', function () {
                checkItems.forEach(item => {
                    item.checked = this.checked;
                });
                calculateSubtotal();
            });

            checkItems.forEach(item => {
                item.addEventListener('change', calculateSubtotal);
            });

            calculateSubtotal();
        });

    function decrementQuantity(cartItemId, buttonElement, normalPrice) {
        const inputElement = buttonElement.nextElementSibling;
        const currentQuantity = parseInt(inputElement.value, 10);

        if (currentQuantity > 1) {
            const newQuantity = currentQuantity - 1;
            inputElement.value = newQuantity;

            buttonElement.disabled = newQuantity <= 1;

            updateQuantityOnServer(cartItemId, newQuantity, normalPrice);

            updatePrice(cartItemId, normalPrice, newQuantity);
        }
    }

    function incrementQuantity(cartItemId, buttonElement, normalPrice) {
        const inputElement = buttonElement.previousElementSibling;
        const currentQuantity = parseInt(inputElement.value, 10);
        const newQuantity = currentQuantity + 1;

        inputElement.value = newQuantity;

        const decrementButton = inputElement.previousElementSibling;
        decrementButton.disabled = false;

        updateQuantityOnServer(cartItemId, newQuantity, normalPrice);

        updatePrice(cartItemId, normalPrice, newQuantity);
    }

    function updateQuantityOnServer(cartItemId, newQuantity, normalPrice) {
        const actionUrl = "{{ route('cart.updateQuantity') }}";
        const csrfToken = "{{ csrf_token() }}";

        fetch(actionUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({
                quantity: { [cartItemId]: newQuantity }
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Quantity updated successfully.');
            } else {
                alert(data.message || 'Failed to update cart.');
                const input = document.querySelector(`input[data-id="${cartItemId}"]`);
                input.value = input.defaultValue;
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function updatePrice(cartItemId, pricePerItem, quantity) {
        const priceElement = document.getElementById(`price-${cartItemId}`);
        const totalPrice = pricePerItem * quantity;

        const formattedPrice = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(totalPrice);

        priceElement.textContent = formattedPrice.replace('IDR', 'Rp');

        calculateSubtotal();
    }

    function calculateSubtotal() {
        const checkItems = document.querySelectorAll('.check-item');
        const subtotalElement = document.getElementById('subtotal');
        let subtotal = 0;

        checkItems.forEach(item => {
            if (item.checked) {
                const row = item.closest('tr');
                const price = parseFloat(row.dataset.price);
                const quantity = parseInt(row.querySelector('.quantity-input').value, 10);
                subtotal += price * quantity;
            }
        });

        subtotalElement.textContent = `Subtotal: ${formatRupiah(Math.round(subtotal))}`;
    }

    function formatRupiah(number) {
        return 'Rp ' + number.toLocaleString('id-ID', { useGrouping: true }).replace(/,/g, '.');
    }
    </script>
</x-template>
