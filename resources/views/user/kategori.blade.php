<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Kategori - DelCafe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/kategori.css') }}">
    <script defer src="https://use.fontawesome.com/releases/v5.8.1/js/all.js"></script>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Logo and Brand Name -->
            <div class="logo d-flex align-items-center">
                <img src="{{ asset('logo/logo.png') }}" alt="delCafe Logo" class="logo-img">
            </div>

            <!-- Navigation Menu -->
            <nav class="nav">
                <a href="{{ route('user.dashboard') }}" class="nav-link">Beranda</a>
                <a href="#" class="nav-link">Pesanan saya</a>
            </nav>

            <!-- Search, Cart, and User Icon -->
            <div class="icons d-flex align-items-center">
                <!-- Search Bar -->
                <div class="search-box">
                    <form action="{{ route('product.search') }}" method="GET">
                        <div class="search-container">
                            <input type="text" name="search" placeholder="Cari produk..." required>
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>


                <!-- cart icon -->
                <a href="#" class="cart-icon">
                    <button class="btn" id="cart"><i class="fas fa-shopping-cart"
                            style="font-size: 25px;"></i>(0)</button>
                </a>

                <!-- user dropdown -->
                <div class="dropdown">
                    <button class="user-icon dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="user-initial">{{ strtoupper(auth()->user()->name[0]) }}</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <div class="dropdown-header">
                            <strong>{{ auth()->user()->name }}</strong><br>
                            <small>{{ auth()->user()->email }}</small><br>
                        </div>
                        <a class="dropdown-item" href="#">Pesanan saya</a>
                        <hr>
                        <!-- logout -->
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">Keluar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
        </script>
        <script defer src="https://use.fontawesome.com/releases/v5.8.1/js/all.js"
            integrity="sha384-g5uSoOSBd7KkhAMlnQILrecXvzst9TdC09/VM+pjDTCM+1il8RHz5fKANTFFb+gQ" crossorigin="anonymous">
        </script> --}}
    </header>

    <!-- -------- -->
    {{-- <div class="image-produk d-flex justify-content-center">
                <img src="{{ asset('kategoris/' . $kategori->gambar) }}" class="img-fluid" alt="...">
             </div>
             <div class="text-kategory" style="margin-left: 310px; margin-top:50px">
                <h3>{{ $kategori->nama }}</h3>
            </div>
            <section>
                <div class="container">
                    <div class="row">
                        @foreach ($produks as $produk)
                        <div class="col-md-4 col-lg-3 mb-4">
                            <div class="card h-100" style="width: 100%">
                                <a href="{{ route('user.show', $produk->id) }}">
                                    <img src="{{ asset('gambar/' . $produk->gambar) }}" class="card-img-top mt-2" alt="..." style="width: 90%; display: block; margin: 0 auto;">
                                </a>
                                <div class="card-body">
                                    <p class="card-text" style="font-weight: bold; font-size: 20px; margin-bottom: 3px;">{{ $produk->judul }}</p>
                                    <!-- deskripsi -->
                                    <p class="card-text">{{ Str::limit($produk->deskripsi, 50) }}</p>
                                    <!-- harga -->
                                    <p class="card-text">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section> --}}

    <!-- Gaya tambahan di dalam tag <style> -->
    {{-- <style>
        .text-kategory {
            margin-top: 20px;
            text-align: center;
        }

        /* .image-produk img {
        height: 100px;
    } */

        .card img {
            max-height: 200px;
            object-fit: cover;
        }

        .card-body {
            text-align: center;
        }

        .card-text-title {
            font-weight: bold;
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .card-text-price {
            color: #28a745;
            font-size: 1.1rem;
            font-weight: bold;
        }
    </style> --}}

    <!-- Layout HTML yang telah diperbaiki -->
    {{-- <div class="image-produk d-flex justify-content-center">
    <img src="{{ asset('kategoris/' . $kategori->gambar) }}" class="img-fluid " style="width: 100px; height: 100px;" alt="...">
</div> --}}

    <!-- Layout HTML dengan gambar yang melebar penuh -->
    <!-- Layout HTML dengan gambar yang melebar penuh ke ujung layar -->
    <!-- Banner Image -->
    <div class="image-produk my-2" style="width: 100%; margin: 0; padding: 0; overflow: hidden;">
        <img src="{{ asset('kategoris/' . $kategori->gambar) }}" class="img-fluid"
            style="width: 100vw; height: 400px; object-fit: cover; object-position: center;" alt="Gambar Kategori">
    </div>

    <div class="text-kategory" style="margin-left: 550px; margin-top: 50px; margin-bottom: 20px;">
        <h3>{{ $kategori->nama }}</h3>
    </div>

    <section>
        <div class="container">
            <div class="row">
                @foreach ($produks as $produk)
                    <div class="col-md-4 col-lg-3 mb-4">
                        <div class="card h-100" style="width: 100%">
                            <a href="{{ route('user.show', $produk->id) }}">
                                <img src="{{ asset('gambar/' . $produk->gambar) }}" class="card-img-top mt-2"
                                    alt="..." style="width: 90%; display: block; margin: 0 auto;">
                            </a>
                            <div class="card-body">
                                <p class="card-text" style="font-weight: bold; font-size: 20px; margin-bottom: 3px;">
                                    {{ $produk->judul }}</p>
                                <!-- deskripsi -->
                                <p class="card-text">{{ Str::limit($produk->deskripsi, 50) }}</p>
                                <!-- harga -->
                                <p class="card-text-price">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-left">
                <h3>Contact Us</h3>
                <p>Find your food here</p>
                <p><i class="fa fa-envelope"></i> delcafe@gmail.com</p>
                <p>
                    {{-- <i class="fa fa-phone"></i>  --}}
                    <a href="https://wa.me/6287844043032" target="_blank" class="whatsapp-link">
                        <i class="fab fa-whatsapp"></i> +628123456789
                    </a>
                </p>
            </div>
            <div class="footer-right">
                <img src="{{ asset('logo/icon 1.png') }}" alt="delCafe Logo" class="footer-logo"
                    style="margin-right: 15px;">
                <h2>delCafe</h2>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
