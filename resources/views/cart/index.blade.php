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
                                    <p class="price mb-0">
                                        Rp {{ number_format($priceAfterDiscount * $item->quantity, 0, '.', '.') }}
                                    </p>
                                </td>

                                <!-- Quantity -->
                                <td class="align-middle">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <button type="submit" name="action" value="decrement-{{ $item->id }}" class="btn btn-secondary btn-sm quantity-btn" {{ $item->quantity == 1 ? 'disabled' : '' }}>-</button>
                                        <input
                                            type="number"
                                            name="quantity[{{ $item->id }}]"
                                            value="{{ $item->quantity }}"
                                            min="1"
                                            class="form-control form-control-sm quantity-input text-center"
                                            style="width: 60px;"
                                            data-id="{{ $item->id }}"
                                            onchange="updateQuantity(this)">
                                        <button type="submit" name="action" value="increment-{{ $item->id }}" class="btn btn-secondary btn-sm quantity-btn">+</button>
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
        function updateQuantity(inputElement) {
            const cartItemId = inputElement.dataset.id; // ID dari item cart
            const quantity = inputElement.value; // Nilai kuantitas
            const actionUrl = "{{ route('cart.update') }}"; // URL untuk update cart

            // Validasi input agar tidak kurang dari 1
            if (quantity < 1) {
                alert('Quantity must be at least 1.');
                inputElement.value = 1; // Reset ke 1
                return;
            }

            // Kirim request menggunakan Fetch API
            fetch(actionUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    quantity: { [cartItemId]: quantity } // Format data quantity sesuai kebutuhan controller
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Quantity updated successfully.');
                    // Anda bisa menambahkan logika untuk memperbarui subtotal atau UI lainnya
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
    </script>
</x-template>
