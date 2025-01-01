<x-template title="Home" :showFilters="$showFilters">
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <!-- Newest Product Banner -->
            <div class="carousel-item active">
                <a href="{{ route('products.list') }}">
                    <img src="{{ asset('assets/NEW.png') }}" class="d-block w-100" alt="Newest Product">
                </a>
            </div>

            <!-- Category Banners -->
            <div class="carousel-item">
                <a href="{{ route('products.list', ['category' => 1]) }}">
                    <img src="{{ asset('assets/1.png') }}" class="d-block w-100" alt="Category 1">
                </a>
            </div>
            <div class="carousel-item">
                <a href="{{ route('products.list', ['category' => 2]) }}">
                    <img src="{{ asset('assets/2.png') }}" class="d-block w-100" alt="Category 2">
                </a>
            </div>
            <div class="carousel-item">
                <a href="{{ route('products.list', ['category' => 3]) }}">
                    <img src="{{ asset('assets/3.png') }}" class="d-block w-100" alt="Category 3">
                </a>
            </div>
            <div class="carousel-item">
                <a href="{{ route('products.list', ['category' => 4]) }}">
                    <img src="{{ asset('assets/4.png') }}" class="d-block w-100" alt="Category 3">
                </a>
            </div>
            <div class="carousel-item">
                <a href="{{ route('products.list', ['category' => 5]) }}">
                    <img src="{{ asset('assets/5.png') }}" class="d-block w-100" alt="Category 3">
                </a>
            </div>
            <div class="carousel-item">
                <a href="{{ route('products.list', ['category' => 6]) }}">
                    <img src="{{ asset('assets/6.png') }}" class="d-block w-100" alt="Category 3">
                </a>
            </div>
            <div class="carousel-item">
                <a href="{{ route('products.list', ['category' => 7]) }}">
                    <img src="{{ asset('assets/7.png') }}" class="d-block w-100" alt="Category 3">
                </a>
            </div>
            <div class="carousel-item">
                <a href="{{ route('products.list', ['category' => 8]) }}">
                    <img src="{{ asset('assets/8.png') }}" class="d-block w-100" alt="Category 3">
                </a>
            </div>
            <div class="carousel-item">
                <a href="{{ route('products.list', ['category' => 9]) }}">
                    <img src="{{ asset('assets/9.png') }}" class="d-block w-100" alt="Category 3">
                </a>
            </div>
            <!-- Add more category images similarly -->
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

</x-template>
