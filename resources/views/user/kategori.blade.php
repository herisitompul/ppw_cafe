<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Kategori - DelCafe</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        <script defer src="https://use.fontawesome.com/releases/v5.8.1/js/all.js"></script>
    </head>
<body>
        <!-- Header -->
        <header class="header">
            <div class="container d-flex justify-content-between align-items-center">
                <!-- Logo and Brand Name -->
                <div class="logo d-flex align-items-center">
                    <img src="logo/logo.png" alt="delCafe Logo" class="logo-img">
                </div>

                <!-- Navigation Menu -->
                <nav class="nav">
                    <a href="dashboard.html" class="nav-link">Beranda</a>
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
                    <a href="#" class="cart-icon">
                        <button class="btn" id="cart"><i class="fas fa-shopping-cart" style="font-size: 25px;"></i>(0)</button>
                    </a>

                    <!-- user dropdown -->
                    <div class="dropdown">
                            <button class="user-icon dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <!-- inisial user-->
                            <span class="user-initial">A</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <div class="dropdown-header">
                            <!-- nama dan email user -->
                            <strong>name</strong><br>
                            <small>email</small><br>
                    </div>
                            <a class="dropdown-item" href="#">Pesanan saya</a><hr>
                            <!-- logout -->
                                <form action="#" method="POST">
                                <button type="submit" class="dropdown-item">Keluar</button>
                            </form>
                            </div>
                    </div>
                </div>
            </div>
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
            <script defer src="https://use.fontawesome.com/releases/v5.8.1/js/all.js" integrity="sha384-g5uSoOSBd7KkhAMlnQILrecXvzst9TdC09/VM+pjDTCM+1il8RHz5fKANTFFb+gQ" crossorigin="anonymous"></script>
            </header>

            <!-- -------- -->
             <div class="image-produk d-flex justify-content-center">
                <img src="kategori/kategori.png" alt="produk1">
             </div>
             <div class="text-kategory" style="margin-left: 450px;">
                <h5>Beranda / Makanan</h5>
                <h3>Makanan</h3>
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
            </section>

                    <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="footer-left">
                    <h3>Contact Us</h3>
                    <p>Find your food here</p>
                    <p><i class="fa fa-envelope"></i> delcafe@gmail.com</p>
                    <p><i class="fa fa-phone"></i> +628123456789</p>
                </div>
                <div class="footer-right">
                    <img src="logo/icon 1.png" alt="delCafe Logo" class="footer-logo" style="margin-right: 15px;">
                    <h2>delCafe</h2>
                </div>
            </div>
        </footer>
