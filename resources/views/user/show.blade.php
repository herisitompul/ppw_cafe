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
        <style>
            .product-image {
                /* max-width: 100%; */
                width: 500px;
                height: auto;
                margin-left: 140px;
            }
            .thumbnail-image {
                width: 100px;
                height: auto;
                margin-right: 10px;
            }
            .product-detail {
                padding-left: 30px;
            }
            .product-detail p{
                width: 80%;
            }

        </style>
<body>
        <!-- Header -->
        <header class="header">
            <div class="container d-flex justify-content-between align-items-center">
                <!-- Logo and Brand Name -->
                <div class="logo d-flex align-items-center">
                    <img src="{{ asset('logo/logo.png') }}"  alt="delCafe Logo" class="logo-img">
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
                    <a href="#" class="cart-icon"data-bs-toggle="modal" data-bs-target="#cartModal">
                        <button class="btn" id="cart"><i class="fas fa-shopping-cart" style="font-size: 25px;"></i>(<span id="cart-count">0</span>)</button>
                    </a>
                    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-fullscreen">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="cartModalLabel">Keranjang Anda</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" id="cart-items">
                                    <!-- Keranjang Kosong atau Item akan ditampilkan disini -->
                                </div>
                                <div class="modal-footer">
                                    <p id="subtotal-text" class="me-auto">Subtotal: Rp0,00</p>
                                    <button class="btn btn-primary">Beli Sekarang</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        function updateCartCount() {
                            const cart = JSON.parse(localStorage.getItem("cart")) || [];
                            const cartCount = cart.reduce((total, item) => total + item.quantity, 0);
                            document.getElementById("cart-count").innerText = cartCount;
                        }
                
                        function displayCartItems() {
                            const cart = JSON.parse(localStorage.getItem("cart")) || [];
                            const cartItemsContainer = document.getElementById("cart-items");
                            cartItemsContainer.innerHTML = "";
                
                            let subtotal = 0;
                            cart.forEach(item => {
                                const itemTotal = item.price * item.quantity;
                                subtotal += itemTotal;
                
                                const itemHTML = `
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="/images/${item.name}.png" alt="${item.name}" style="width:50px;" class="me-2">
                                        <div>
                                            <p>${item.name}</p>
                                            <p>Rp${item.price.toLocaleString()}</p>
                                            <input type="number" class="quantity" value="${item.quantity}" onchange="updateQuantity('${item.id}', this.value)">
                                        </div>
                                    </div>
                                `;
                                cartItemsContainer.insertAdjacentHTML("beforeend", itemHTML);
                            });
                
                            document.getElementById("subtotal-text").innerText = `Subtotal: Rp${subtotal.toLocaleString()}`;
                        }
                
                        function addToCart() {
                            const quantity = parseInt(document.getElementById("quantity").value);
                            const product = {
                                id: "{{ $produk->id }}",
                                name: "{{ $produk->judul }}",
                                price: {{ $produk->harga }},
                                quantity: quantity
                            };
                
                            const cart = JSON.parse(localStorage.getItem("cart")) || [];
                            const existingProduct = cart.find(item => item.id === product.id);
                            if (existingProduct) {
                                existingProduct.quantity += quantity;
                            } else {
                                cart.push(product);
                            }
                
                            localStorage.setItem("cart", JSON.stringify(cart));
                            updateCartCount();
                            displayCartItems();
                        }
                
                        document.addEventListener("DOMContentLoaded", function() {
                            updateCartCount();
                            displayCartItems();
                        });
                    </script>

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
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
            <script defer src="https://use.fontawesome.com/releases/v5.8.1/js/all.js" integrity="sha384-g5uSoOSBd7KkhAMlnQILrecXvzst9TdC09/VM+pjDTCM+1il8RHz5fKANTFFb+gQ" crossorigin="anonymous"></script>
            </header>

            <!-- -------- -->
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset('gambar/' . $produk->gambar) }}" alt="Bakwan Saus Kacang" class="product-image" height="400" width="600" style="border-radius: 10px"/>
                        <div class="d-flex mt-3" style="margin-left: 145px;">
                            <img src="{{ asset('gambar/' . $produk->gambar) }}" alt="Thumbnail 1" class="thumbnail-image">
                            <img src="produk/bakwan.png" alt="Thumbnail 2" class="thumbnail-image">
                            <img src="produk/bakwan.png" alt="Thumbnail 3" class="thumbnail-image">
                        </div>
                    </div>
                        <div class="col-md-6 product-detail">
                            <h3>{{ $produk->judul }}</h3>
                            <h4>Rp {{ number_format($produk->harga, 0, ',', '.') }}</h4>
                            <p>{{ $produk->deskripsi }}</p>
                            <p><strong>Kuantitas:</strong></p>
                            <div class="d-flex align-items-center mb-3">
                                <button class="btn btn-outline-secondary" onclick="decreaseQuantity()">-</button>
                                <input type="text" id="quantity" class="form-control text-center mx-2" value="1" style="width: 50px;">
                                <button class="btn btn-outline-secondary" onclick="increaseQuantity()">+</button>
                            </div>
                            <script>
                                // Fungsi untuk menambah kuantitas
                                function increaseQuantity() {
                                    const quantityInput = document.getElementById("quantity");
                                    let quantity = parseInt(quantityInput.value);
                                    quantity += 1;
                                    quantityInput.value = quantity;
                                }
                            
                                // Fungsi untuk mengurangi kuantitas
                                function decreaseQuantity() {
                                    const quantityInput = document.getElementById("quantity");
                                    let quantity = parseInt(quantityInput.value);
                                    if (quantity > 1) {
                                        quantity -= 1;
                                    }
                                    quantityInput.value = quantity;
                                }
                            </script>
                            <p><strong>Stok: {{ $produk->stok }}</strong></p>
                            <div class="d-flex mb-3">
<!-- Tambahkan ID pada tombol "Masukkan Keranjang" -->
<div class="d-flex mb-3">
    <button class="btn btn-secondary mr-2" onclick="addToCart()">Masukkan Keranjang</button>
    <button class="btn btn-success mx-2">Beli Sekarang</button>
</div>


<script>
    // Fungsi untuk mendapatkan jumlah item di keranjang
    function updateCartCount() {
        const cart = JSON.parse(localStorage.getItem("cart")) || [];
        const cartCount = cart.reduce((total, item) => total + item.quantity, 0);
        document.getElementById("cart-count").innerText = cartCount;
    }

    // Fungsi untuk menambah produk ke keranjang
    function addToCart() {
        const quantityInput = document.getElementById("quantity");
        const quantity = parseInt(quantityInput.value);
        
        // Contoh data produk yang ditambahkan
        const product = {
            id: "{{ $produk->id }}", // ID produk
            name: "{{ $produk->judul }}", // Nama produk
            price: {{ $produk->harga }}, // Harga produk
            quantity: quantity
        };

        // Ambil keranjang dari localStorage atau buat keranjang baru
        const cart = JSON.parse(localStorage.getItem("cart")) || [];

        // Periksa apakah produk sudah ada di keranjang
        const existingProduct = cart.find(item => item.id === product.id);
        if (existingProduct) {
            existingProduct.quantity += quantity; // Jika sudah ada, tambahkan kuantitas
        } else {
            cart.push(product); // Jika belum ada, tambahkan produk ke keranjang
        }

        // Simpan kembali ke localStorage
        localStorage.setItem("cart", JSON.stringify(cart));

        // Perbarui jumlah produk di ikon keranjang
        updateCartCount();

    }

    // Panggil updateCartCount() saat halaman dimuat untuk menampilkan jumlah item di keranjang
    document.addEventListener("DOMContentLoaded", updateCartCount);
</script>

                                {{-- <button class="btn btn-success mx-2">Beli Sekarang</button> --}}
                            </div>
                            <p>Kategori: {{ $produk->kategori->nama }}</p>
                        </div>
                        </div>
                        </div><br>
                    {{-- </div> --}}
             {{-- <div class="text-kategory" style="margin-left: 450px; margin-top: 3%;">
                <!-- <h5>Beranda / Makanan</h5> -->
                <h3>Kamu mungkin juga suka</h3>
            </div> --}}
            <h2 class="text-center mb-3">Kamu mungkin juga suka</h2>
            {{-- <section>
                <div class="container">
                    <div class="row">
                        @foreach ($produks as $produk)
                        <div class="col-md-3 mb-4">
                            <div class="card h-100" style="width: 250%;">
                                <div class="container">
                                    <!-- Link ke halaman detail produk -->
                                    <a href="{{ route('user.show', $produk->id) }}">
                                        <img src="{{ asset('gambar/' . $produk->gambar) }}" class="card-img-top mt-2" alt="{{ $produk->judul }}" style="height: 130px; object-fit: cover; width: 100%; display: block; margin: 0 auto;">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <p class="card-text" style="font-weight: bold; font-size: 20px; margin-bottom: 3px;">
                                        <!-- Link ke halaman detail produk pada judul -->
                                        <a href="{{ route('user.show', $produk->id) }}" style="text-decoration: none; color: black;">
                                            {{ $produk->judul }}
                                        </a>
                                    </p>
                                    <!-- Deskripsi Singkat -->
                                    <p class="card-text">{{ Str::limit($produk->deskripsi, 50) }}</p>
                                    <p class="card-text">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section> --}}
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
                <p><i class="fa fa-phone"></i> +628123456789</p>
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


