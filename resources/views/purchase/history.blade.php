<x-template title="Purchase History">
    <div class="container mt-4">
        <h1>Purchase History</h1>

        @if ($purchaseHistory->isEmpty())
            <div style="text-align: center; margin-top: 50px;">
                <p>You have no purchase history yet.</p>
                <a href="{{ route('home') }}" class="btn btn-primary">Shop Now</a>
            </div>
        @else
            @foreach ($purchaseHistory as $purchase)
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Order #{{ $purchase->id }}</h5>
                        <p><strong>Date:</strong> {{ $purchase->created_at->format('d M Y, H:i') }}</p>
                        <p><strong>Receiver:</strong> {{ $purchase->receiver }}</p>
                        <p><strong>Phone:</strong> {{ $purchase->phone }}</p>
                        <p><strong>Address:</strong> {{ $purchase->address }}</p>
                        <p><strong>Status:</strong>
                            <span class="badge {{ $purchase->status == 'delivered' ? 'bg-success' : ($purchase->status == 'pending' ? 'bg-warning' : 'bg-danger') }}">
                                {{ ucfirst($purchase->status) }}
                            </span>
                        </p>
                        <p><strong>Total Price:</strong> Rp {{ number_format($purchase->paid_price, 0, '.', '.') }}</p>

                        <h6 class="mt-3">Items:</h6>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchase->CheckoutLists as $item)
                                    @php
                                        $priceAfterDiscount = $item->product->price - ($item->product->price * $item->product->discount / 100);
                                        $itemTotal = $priceAfterDiscount * $item->quantity;
                                    @endphp
                                    <tr>
                                        <td>{{ $item->product->name }}</td>
                                        <td>Rp {{ number_format($priceAfterDiscount, 0, '.', '.') }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>Rp {{ number_format($itemTotal, 0, '.', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</x-template>
