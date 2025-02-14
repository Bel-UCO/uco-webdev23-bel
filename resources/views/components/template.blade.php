<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">


    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <style>
        /* Ensure the page layout fills the viewport */
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1; /* Pushes the footer down */
        }

        .footer {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 10px;
            background-color: #363636;
            color: white;
        }

        .footer a {
            text-decoration: none;
            color: white;
            padding: 5px 10px;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .footer p {
            margin: 0;
            padding: 5px 10px;
        }
    </style>
</head>

<body>


    <nav class="navbar navbar-expand-lg bg-body-tertiary" style="display: flex; flex-direction:">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/adidas-logo.png') }}" alt="Logo" width="40" height="40" class="d-inline-block align-text-top">
            </a>
            <!-- Tombol Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <img src="{{ asset('assets/adidas-logo.png') }}" alt="Logo" width="30" height="30">
            </button>
            <!-- Menu Navigasi -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('products.list') }}">All Products</a>
                    </li>

                    @cannot('is-admin')
                    @foreach(\App\Models\Category::getOrdered() as $category)

                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('products.list', ['category' => $category->id]) }}">{{ $category->name }}</a>
                    </li>
                    @endforeach
                    @endcannot

                    <li class="nav-item">
                        @can('is-admin')
                            <a class="nav-link active" style="color:blue" aria-current="page" href="{{ route('admin.home') }}">ADMIN EDIT</a>
                        @endcan
                    </li>

                </ul>
                <!-- Form Pencarian -->
                <form class="d-flex align-items-center" role="search" action="{{ route('products.search') }}" method="GET">

                    <input class="form-control me-2" type="search" name="keyword" placeholder="Search" aria-label="Search" required>
                    <button class="btn btn-secondary" type="submit" style="margin-right:10px">Search</button>

                </form>
                @auth

                @cannot('is-admin')
                <a href={{ route('cart.list') }}>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="25"
                        height="25"
                        fill="black"
                        class="bi bi-cart"
                        viewBox="0 0 20 20"
                        style="margin-left: 10px;">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                    </svg>
                </a>
                @endcannot

                    <div class="dropdown">
                        <a class="btn dropdown-toggle border" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->name }}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">

                            @cannot('is-admin')
                            {{-- <li><a class="dropdown-item" href="#">Profile</a></li> --}}
                            <li><a class="dropdown-item" href="{{route('favorites.view')}}">Favorites</a></li>
                            <li><a class="dropdown-item" href="{{ route('purchase.history') }}">Purchase history</a></li>
                            <li><hr class="dropdown-divider"></li>
                            @endcannot

                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Log out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary text-nowrap">Login</a>
                @endauth
            </div>

        </div>
    </nav>
    <div class="container mt-6" style="display: flex; justify-content:end">
        <div class="row" style="display: flex; justify-content:right">
            <!-- Filter akan ditampilkan hanya jika $showFilters bernilai true -->
            @if($showFilters ?? false)
                <!-- Sorting Filter -->
                <div class="col-md-6">
                    <form method="GET" action="{{ route('products.list') }}" class="d-flex">
                        <div class="form-group me-2">
                            <select class="form-select" id="sort_by" name="sort_by">
                                <option value="name_asc" @if(request('sort_by') == 'name_asc') selected @endif>Name Ascending</option>
                                <option value="name_desc" @if(request('sort_by') == 'name_desc') selected @endif>Name Descending</option>
                                <option value="price_asc" @if(request('sort_by') == 'price_asc') selected @endif>Price Low to High</option>
                                <option value="price_desc" @if(request('sort_by') == 'price_desc') selected @endif>Price High to Low</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-secondary">Apply</button>
                    </form>
                </div>

                <!-- Price Range Filter -->
                <div class="col-md-6">
                    <form method="GET" action="{{ route('products.list') }}" class="d-flex">
                        <div class="form-group me-2">
                            <input type="number" class="form-control" id="min_price" name="min_price" placeholder="Min Price" value="{{ request('min_price') }}">
                        </div>
                        <div class="form-group me-2">
                            <input type="number" class="form-control" id="max_price" name="max_price" placeholder="Max Price" value="{{ request('max_price') }}">
                        </div>
                        <button type="submit" class="btn btn-secondary">Apply</button>
                    </form>
                </div>
            @endif
        </div>
    </div>

    <!-- Placeholder Konten -->
    <main class="container mt-4">
        {{ $slot }}
        <br>
    </main>

    <div class="footer">
        <a href="{{ route('static.about') }}">About Adidas Products</a>
        <p>|</p>
        <a href="{{ route('static.sites') }}">Using Our Sites</a>
        <p>|</p>
        <a href="{{ route('static.delivery') }}">Delivery Inquiries</a>
        <p>|</p>
        <p>© 2021 Adidas</p>
    </div>
</body>
</html>
