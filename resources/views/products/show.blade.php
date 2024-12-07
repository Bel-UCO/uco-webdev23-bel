<x-template title="{{ $product->subCategory . ' ' . $product->name }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <div style="display: flex; flex-direction: row; justify-content: center;">

        <div class="container" style="max-width: 600px; margin: auto;">
            <!-- Swiper -->
            <div class="swiper-container" style="width: 600px; height: 600px; position: relative; overflow: hidden; margin: 0 auto;">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="{{ asset('assets/products/' . $product->subCategory . '/' . $product->name . '/1.jpg') }}"
                            alt="Product Image"
                            style="width: 100%; height: 100%; object-fit: cover;"
                            onerror="this.onerror=null;this.src='https://fastly.picsum.photos/id/468/350/350.jpg?hmac=4jGTGKUJEby3tFz0qbVu3WGj1yrH6k2JZVcnjAIkAz0';">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ $product->image1 }}"
                            alt="Product Image"
                            style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ $product->image2 }}"
                            alt="Product Image"
                            style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                </div>

                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>

                <!-- Add Navigation -->
                <div class="swiper-button-next" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%);"></div>
                <div class="swiper-button-prev" style="position: absolute; top: 50%; left: 10px; transform: translateY(-50%);"></div>
            </div>
        </div>

        <div style="width: 300px; margin-left:20pt">
            <h5 style="color: gray"> {{$product->category}} </h5>
            <h1 style="color: black">{{$product->subCategory . ' ' . $product->name}}</h1>
            <p class="card-text" style="font-size: 16pt; color:red;">
                {{ 'Rp. ' . number_format($product->price * ((100 - $product->discount) / 100), 0, ',', '.') }}
                <span style="color: gray"><s>{{ 'Rp. ' . number_format($product->price, 0, ',', '.') }}</s></span>
                <span style="color: black"> {{$product->discount}}% </span>
            </p>
            <br><br><br>
            <div style="display: flex; flex-direction: column; align-items: center; margin-top: 20px;">
                <!-- Tombol Edit -->
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary" style="width: 100%; text-align: center;">
                    Edit
                </a>
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
