<x-template title="Home" :showFilters="$showFilters">

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <!-- Newest Product Banner -->
            <div class="carousel-item active">
                <a href="{{ route('products.list') }}">
                    @if($image && $image->image)
                        <img src="{{ asset($image->image) }}" class="d-block w-100" alt="Newest Product"
                             onerror="this.onerror=null;this.src='{{ asset('assets/NEW.jpg') }}';">
                    @else
                        <img src="{{ asset('assets/NEW.jpg') }}" class="d-block w-100" alt="Fallback Image">
                    @endif
                </a>


                @can('is-admin')
                <a href="{{ route('landing.edit') }}">
                    <i class="fa-solid fa-pen-to-square fa-lg" style="position: absolute; top: 20px; right: 200px; color: rgba(255, 255, 255, 0.8);"></i>
                </a>
                @endcan

            </div>

            @foreach ($categories as $category)
            <div class="carousel-item">
                <a href="{{ route('products.list', ['category' => $category->order_no]) }}">
                    <img src="{{ asset($category->image) }}" class="d-block w-100" alt="Category {{ $category->order_no }}">
                </a>
            </div>
            @endforeach

0
            {{-- <!-- Category Banners -->
            <div class="carousel-item">
                <a href="{{ route('products.list', ['category' => 1]) }}">
                    <img src="{{ asset('assets/1.jpg') }}" class="d-block w-100" alt="Category 1">
                </a>
            </div>
            <div class="carousel-item">
                <a href="{{ route('products.list', ['category' => 2]) }}">
                    <img src="{{ asset('assets/2.jpg') }}" class="d-block w-100" alt="Category 2">
                </a>
            </div>
            <div class="carousel-item">
                <a href="{{ route('products.list', ['category' => 3]) }}">
                    <img src="{{ asset('assets/3.jpg') }}" class="d-block w-100" alt="Category 3">
                </a>
            </div>
            <div class="carousel-item">
                <a href="{{ route('products.list', ['category' => 4]) }}">
                    <img src="{{ asset('assets/4.jpg') }}" class="d-block w-100" alt="Category 3">
                </a>
            </div>
            <div class="carousel-item">
                <a href="{{ route('products.list', ['category' => 5]) }}">
                    <img src="{{ asset('assets/5.jpg') }}" class="d-block w-100" alt="Category 3">
                </a>
            </div>
            <div class="carousel-item">
                <a href="{{ route('products.list', ['category' => 6]) }}">
                    <img src="{{ asset('assets/6.jpg') }}" class="d-block w-100" alt="Category 3">
                </a>
            </div>
            <div class="carousel-item">
                <a href="{{ route('products.list', ['category' => 7]) }}">
                    <img src="{{ asset('assets/7.jpg') }}" class="d-block w-100" alt="Category 3">
                </a>
            </div>
            <div class="carousel-item">
                <a href="{{ route('products.list', ['category' => 8]) }}">
                    <img src="{{ asset('assets/8.jpg') }}" class="d-block w-100" alt="Category 3">
                </a>
            </div>
            <div class="carousel-item">
                <a href="{{ route('products.list', ['category' => 9]) }}">
                    <img src="{{ asset('assets/9.jpg') }}" class="d-block w-100" alt="Category 3">
                </a>
            </div> --}}

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
