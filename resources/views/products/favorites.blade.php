<x-template title='My Favorites' :showFilters="false">

    @if ($favorites->isEmpty())
        <div style="display:flex; align-items:center; justify-content:center; height:400px">
            <p>You don't have any favorite items yet.</p>
        </div>
    @else
        <div class="row" style="margin: 10pt 20pt 0pt 20pt">
            @foreach ($favorites as $favorite)
                @php $product = $favorite->product; @endphp
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
                                    {{ $product->category->name }}
                                </p>

                                <h5 class="card-title" style="font-size:10pt">{{ $product->name . ' ' . $product->subcategory }}</h5>

                                <p class="card-text" style="font-size: 10pt;">
                                    @if ($product->discount > 0)
                                        <span style="color:red;">
                                            {{ 'Rp. ' . number_format($product->price * ((100 - $product->discount) / 100), 0, ',', '.') }}
                                        </span>
                                        <span style="color: gray"><s>
                                            {{ 'Rp. ' . number_format($product->price, 0, ',', '.') }}
                                        </s></span>
                                        <span style="color: black"> {{ $product->discount }}% </span>
                                    @else
                                        <span style="color:black;">
                                            {{ 'Rp. ' . number_format($product->price, 0, ',', '.') }}
                                        </span>
                                    @endif
                                </p>
                            </div>

                            <!-- Button to remove from favorites -->
                            <div style="position: absolute; bottom: 10px; right: 10px;">
                                <form action="{{ route('favorites.remove', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: none; border: none; cursor: pointer;">
                                        <i class="fa-solid fa-heart" style="color: red; font-size: 1.5rem;"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif

</x-template>
