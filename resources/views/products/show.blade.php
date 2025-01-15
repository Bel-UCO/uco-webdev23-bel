<x-template title="{{ $product->subCategory . ' ' . $product->name }}" :showFilters="$showFilters">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <div style="display: flex; flex-direction: row; justify-content: center;">

        <div class="container" style="max-width: 600px; margin: auto;">
            <!-- Swiper -->
            <div class="swiper-container" style="width: 600px; height: 600px; position: relative; overflow: hidden; margin: 0 auto;">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="{{ route('products.image1', ['id' => $product->id]) }}"
                            alt="Product Image"
                            style="width: 100%; height: 100%; object-fit: cover;"
                            onerror="this.onerror=null;this.src='https://fastly.picsum.photos/id/468/350/350.jpg?hmac=4jGTGKUJEby3tFz0qbVu3WGj1yrH6k2JZVcnjAIkAz0';">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ route('products.image2', ['id' => $product->id]) }}"
                            alt="Product Image"
                            style="width: 100%; height: 100%; object-fit: cover;"
                            onerror="this.onerror=null;this.src='https://fastly.picsum.photos/id/274/350/350.jpg?hmac=untj6RC6C78hvqY-k-jH_U0li8N1hzcH_dQeaW2jlW0">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ route('products.image3', ['id' => $product->id]) }}"
                            alt="Product Image"
                            style="width: 100%; height: 100%; object-fit: cover;"
                            onerror="this.onerror=null;this.src='https://fastly.picsum.photos/id/1025/350/350.jpg?hmac=H6E-8iwt33C43jRY3gBG0op4jjFBVNWpgByULLAYd9k">
                    </div>
                </div>

                <!-- Add Pagination -->
                <div class="swiper-pagination text-white"></div>

                <!-- Add Navigation -->
                <div class="swiper-button-next" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); color: rgba(255, 255, 255, 0.6);"></div>
                <div class="swiper-button-prev" style="position: absolute; top: 50%; left: 10px; transform: translateY(-50%); color: rgba(255, 255, 255, 0.6);"></div>
            </div>
        </div>

        <div style="width: 500px; margin-left:20pt">
            <h5 style="color: gray">
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
                                @endif {{$category->name}} </h5>
            <h1 style="color: black">{{ $product->name . ' ' . $product->subcategory }}</h1>
            <p class="card-text" style="font-size: 16pt;
                @if ($product->discount > 0)
                    color:red;
                @else
                    color:black;
                @endif">
                @if ($product->discount > 0)
                    {{ 'Rp. ' . number_format($product->price * ((100 - $product->discount) / 100), 0, ',', '.') }}
                    <span style="color: gray"><s>{{ 'Rp. ' . number_format($product->price, 0, ',', '.') }}</s></span>
                    <span style="color: black"> {{$product->discount}}% </span>
                @else
                    {{ 'Rp. ' . number_format($product->price, 0, ',', '.') }}
                @endif
            </p>
            <br>
            <p>{{ $product->description}}</p>
            <div style="display: flex; flex-direction: row; color: black; width: 100%; justify-content:end;">
                <div>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank">
                        <i class="fab fa-facebook fa-lg me-1" style="color: black"></i>
                    </a>
                </div>
                <div>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($product->name) }}" target="_blank">
                        <i class="fa-brands fa-x-twitter fa-lg me-1" style="color: black"></i>
                    </a>
                </div>
                <div>
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($product->name . ' ' . url()->current()) }}" target="_blank">
                        <i class="fa-brands fa-whatsapp fa-lg" style="color: black"></i></a>
                    </div>
                </div>


                <br><br>

                <div style="display: flex; flex-direction: column; align-items: center; margin-top: 20px;">

                    @can('is-admin')
                    <!-- Tombol Edit -->
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary" style="width: 100%; text-align: center;">
                    Edit
                </a>
                @endcan


                @cannot('is-admin')
                <form method="POST" action="{{ route('cart.add') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="btn btn-primary" style="width: 100%; text-align: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                            <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z"/>
                            <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                          </svg>  Add to Cart
                    </button>
                </form>
                @endcannot

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script>
        // Inisialisasi Swiper
        document.addEventListener('DOMContentLoaded', function () {
            const swiper = new Swiper('.swiper-container', {
                loop: true, // Aktifkan loop
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        });
    </script>
</x-template>
