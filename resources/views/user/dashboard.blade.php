<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - DelCafe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
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
                <a href="#" class="nav-link">Beranda</a>
                <a href="#" class="nav-link">Pesanan saya</a>
            </nav>

            <!-- Search, Cart, and User Icon -->
            <div class="icons d-flex align-items-center">
                <!-- Search Bar -->
                <div class="search-box">
                    <input type="text" placeholder="Search...">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </div>

                <!-- cart icon -->
                <a href="#" class="cart-icon"data-bs-toggle="modal" data-bs-target="#cartModal">
                    <button class="btn" id="cart"><i class="fas fa-shopping-cart" style="font-size: 25px;"></i>(0)
                    </button>
                </a>
                <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-fullscreen">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="cartModalLabel">Keranjang Anda</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Cart Items -->
                                <div class="cart-item d-flex align-items-center mb-3">
                                    <input type="checkbox" class="product-select" data-price="13000">
                                    <img src="{{ asset ('images/pisangcoklat.png')}}" alt="Pisang Coklat Lumer" class="image-product mx-2" style="width: 50px;">
                                    <div>
                                        <p>Pisang Coklat Lumer</p>
                                        <p>Rp13.000,00</p>
                                        <input type="number" class="quantity" min="1" value="1" style="width: 50px;">
                                    </div>
                                </div>
                                <!-- Add more cart items similarly -->
                                <div class="subtotal">
                                    <p>Subtotal: Rp56.000,00</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary">Beli sekarang</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- user dropdown -->
                <div class="dropdown">
                    <button class="user-icon dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="user-initial">{{ strtoupper(auth()->user()->name[0]) }}</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <div class="dropdown-header">
                            <strong>{{ auth()->user()->name }}</strong><br>
                            <small>{{ auth()->user()->email }}</small><br>
                        </div>
                        <a class="dropdown-item" href="#">Pesanan saya</a><hr>
                        <!-- logout -->
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">Keluar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Carousel Section -->
    <div id="carouselExampleIndicators" class="carousel slide mx-2 my-2" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{ asset('slide/slide1.png') }}" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('slide/slide2.png') }}" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('slide/slide3.png') }}" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <section class="culinary-section my-5 text-center">
        <h2 class="mb-4">Aneka kuliner menarik</h2>
        <div class="d-flex justify-content-center">
            <div class="culinary-item mx-3">
                <a href="{{ route('user.kategori', 1) }}"> <!-- Replace '1' with the correct ID -->
                    <img src="{{ asset('kategoris/makanan.png') }}" class="rounded-circle" alt="Makanan" width="130">
                </a>
                <p>Makanan</p>
            </div>
            <div class="culinary-item mx-3">
                <a href="{{ route('user.kategori', 2) }}"> <!-- Replace '2' with the correct ID -->
                    <img src="{{ asset('kategoris/snack.png') }}" class="rounded-circle" alt="Snack" width="130">
                </a>
                <p>Snack</p>
            </div>
            <div class="culinary-item mx-3">
                <a href="{{ route('user.kategori', 3) }}"> <!-- Replace '3' with the correct ID -->
                    <img src="{{ asset('kategoris/minuman.png') }}" class="rounded-circle" alt="Minuman" width="130">
                </a>
                <p>Minuman</p>
            </div>
        </div>
    </section>


    <!-- Product Section -->
<h2 class="text-center mb-3">Apa aja nih yang enak di DelCafe?</h2>
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
                <img src="{{ asset('logo/icon 1.png') }}" alt="delCafe Logo" class="footer-logo" style="margin-right: 15px;">
                <h2>delCafe</h2>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
