<x-template title='Home' :showFilters="$showFilters">
    <div class="row" style="margin: 10pt 20pt 0pt 20pt">
        {{-- <div class="col-12 col-md-12 text-end mb-3">
            <button class="btn btn-secondary" type="button" onclick="window.location.href='{{ route('products.form') }}'">Create +</button>
        </div> --}}
        @if ($products->isEmpty())
            <div style="display:flex; align-items:center; justify-content:center; height:400px">
                <p>There's no such item.</p>
            </div>
        @else
            @foreach ($products as $product)
            {{-- @dd($product) --}}
                <div class="col-3 mb-3 d-flex">
                    <a href="{{ route('products.show', ['id' => $product->id]) }}" style="text-decoration:none; color:black;">
                        <div class="card h-100" style="position: relative;">
                            <img src="{{ route('products.image1', ['id' => $product->id]) }}"
                                class="card-img-top"
                                alt="Product Image"
                                onerror="this.onerror=null;this.src='https://fastly.picsum.photos/id/468/350/350.jpg?hmac=4jGTGKUJEby3tFz0qbVu3WGj1yrH6k2JZVcnjAIkAz0';">
                            <div class="card-body">
                                <!-- Gender display logic -->
                                <p style="color:gray; font-size:8pt">
                                    @if ($product->gender == 'm')
                                        Men
                                    @elseif ($product->gender == 'f')
                                        Women
                                    @elseif ($product->gender == 'k')
                                        Kids
                                    @elseif ($product->gender == 'u')
                                        Unisex
                                    @else
                                        None
                                    @endif
                                {{ $product->category->name }}</p>

                                <h5 class="card-title" style="font-size:10pt">{{ $product->name . ' ' . $product->subcategory }}</h5>

                                <p class="card-text" style="font-size: 10pt;">
                                    <!-- Check if discount > 0 -->
                                    @if ($product->discount > 0)
                                        <!-- Display price after discount -->
                                        <span style="color:red;">
                                            {{ 'Rp. ' . number_format($product->price * ((100 - $product->discount) / 100), 0, ',', '.') }}
                                        </span>
                                        <span style="color: gray"><s>
                                            {{ 'Rp. ' . number_format($product->price, 0, ',', '.') }}
                                        </s></span>
                                        <span style="color: black"> {{ $product->discount }}% </span>
                                    @else
                                        <!-- If no discount, display price normally -->
                                        <span style="color:black;">
                                            {{ 'Rp. ' . number_format($product->price, 0, ',', '.') }}
                                        </span>
                                    @endif
                                </p>
                            </div>
                            <!-- Button to Edit -->
                            {{-- <div style="position: absolute; bottom: 10px; right: 10px;">
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            </div> --}}
                        </div>
                    </a>
                </div>
            @endforeach

        @endif
    </div>

</x-template>
