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
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <script defer src="https://use.fontawesome.com/releases/v5.8.1/js/all.js"></script>
</head>

<body>
    <!-- Header -->
    {{-- <header class="header">
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
                    <form action="{{ route('product.search') }}" method="GET" style="display: flex; width: 100%;">
                        <input type="text" name="search" placeholder="Cari produk..." required>
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>


                <!-- cart icon -->
                <a href="#" class="cart-icon" data-bs-toggle="modal" data-bs-target="#cartModal">
                    <button class="btn" id="cart"><i class="fas fa-shopping-cart"
                            style="font-size: 25px;"></i>(<span id="cart-count">0</span>)</button>
                </a>

                <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-fullscreen">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="cartModalLabel">Keranjang Anda</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="cart-items">
                                <!-- Cart Items will be rendered here -->
                            </div>
                            <div class="modal-footer">
                                <p id="subtotal-text" class="me-auto">Subtotal: Rp0,00</p>
                                <button class="btn btn-primary">Beli Sekarang</button>
                            </div>
                        </div>
                    </div>
                </div>

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
    </header> --}}
    @include('user.layout.header')
    @if (isset($message))
        <div class="alert alert-warning text-center" role="alert">
            {{ $message }}
        </div>
    @endif

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

    {{-- <!-- Culinary Section -->
    <section class="culinary-section my-5 text-center">
        <h2 class="mb-4">Aneka kuliner menarik</h2>
        <div class="d-flex justify-content-center gap-5 flex-wrap">
            @foreach ($kategori as $kategori)
                <div class="culinary-item text-center">
                    <a href="{{ route('user.kategori', $kategori->id) }}">
                        <div class="image-container">
                            <img src="{{ asset('kategoris/' . $kategori->gambar) }}" class="rounded-circle"
                                alt="{{ $kategori->nama }}">
                        </div>
                    </a>
                    <p>{{ $kategori->nama }}</p>
                </div>
            @endforeach
        </div>
    </section> --}}



    <!-- Product Section -->
    <h2 class="text-center mb-3">Apa aja nih yang enak di DelCafe?</h2>
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

    <script>
        // Fungsi untuk menambahkan item ke keranjang
        function addToCart(product) {
            const cart = JSON.parse(localStorage.getItem("cart")) || [];
            const existingProductIndex = cart.findIndex(item => item.id === product.id);

            // Jika item sudah ada di keranjang, update jumlahnya
            if (existingProductIndex > -1) {
                cart[existingProductIndex].quantity += product.quantity;
            } else {
                // Jika item baru, tambahkan ke keranjang
                cart.push(product);
            }

            // Simpan keranjang ke localStorage
            localStorage.setItem("cart", JSON.stringify(cart));

            // Update jumlah item di cart icon (agar langsung terlihat)
            updateCartCount();
        }

        // Fungsi untuk memperbarui jumlah item di ikon cart
        function updateCartCount() {
            const cart = JSON.parse(localStorage.getItem("cart")) || [];
            const totalQuantity = cart.reduce((sum, item) => sum + item.quantity, 0);

            // Menampilkan jumlah item di ikon cart
            const cartIcon = document.getElementById("cart-count");
            if (cartIcon) {
                cartIcon.innerText = totalQuantity;
            }
        }

        // Fungsi untuk menghapus item dari keranjang
        function removeFromCart(index) {
            const cart = JSON.parse(localStorage.getItem("cart")) || [];
            cart.splice(index, 1);
            localStorage.setItem("cart", JSON.stringify(cart));

            // Perbarui jumlah item di cart
            updateCartCount();

            // Render ulang item di keranjang
            renderCartItems();
            calculateSubtotal();
        }

        // Pastikan jumlah item di ikon cart diperbarui saat halaman dimuat
        document.addEventListener("DOMContentLoaded", function() {
            updateCartCount(); // Perbarui jumlah item di ikon cart ketika halaman dimuat
        });

        // Fungsi untuk merender isi keranjang
        function renderCartItems() {
            const cart = JSON.parse(localStorage.getItem("cart")) || [];
            const cartItemsContainer = document.getElementById("cart-items");
            cartItemsContainer.innerHTML = "";

            if (cart.length === 0) {
                cartItemsContainer.innerHTML = "<p>Keranjang Anda kosong.</p>";
                document.getElementById("subtotal-text").innerText = "Subtotal: Rp0,00";
                return;
            }

            let subtotal = 0;
            cart.forEach((item, index) => {
                const itemTotalPrice = item.price * item.quantity;
                subtotal += itemTotalPrice;

                cartItemsContainer.innerHTML += `
                    <div class="cart-item d-flex justify-content-between align-items-center mb-2">
                        <input type="checkbox" class="item-checkbox" data-index="${index}" onchange="calculateSubtotal()">
                        <div class="d-flex align-items-center">
                            <img src="${item.image}" alt="${item.name}" class="cart-item-image" style="width: 50px; height: 50px; margin-right: 10px;">
                            <div>
                                <strong>${item.name}</strong><br>
                                <small>Harga: Rp${item.price.toLocaleString()}</small><br>
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-outline-secondary btn-sm" onclick="changeQuantity(${index}, -1)">-</button>
                                    <input type="text" class="form-control text-center mx-2" id="quantity-${index}" value="${item.quantity}" style="width: 50px;" readonly>
                                    <button class="btn btn-outline-secondary btn-sm" onclick="changeQuantity(${index}, 1)">+</button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span id="item-total-${index}" class="me-3">Rp${itemTotalPrice.toLocaleString()}</span>
                            <button class="btn btn-sm p-0" onclick="removeFromCart(${index})">
                                <i class="fas fa-trash-alt" style="color: black;"></i>
                            </button>
                        </div>
                    </div>
                `;
            });

            document.getElementById("subtotal-text").innerText = `Subtotal: Rp${subtotal.toLocaleString()}`;
        }

        // Fungsi untuk menghitung subtotal berdasarkan item yang dipilih
        function calculateSubtotal() {
            const cart = JSON.parse(localStorage.getItem("cart")) || [];
            let subtotal = 0;
            document.querySelectorAll(".item-checkbox").forEach((checkbox) => {
                if (checkbox.checked) {
                    const index = parseInt(checkbox.getAttribute("data-index"));
                    const item = cart[index];
                    subtotal += item.price * item.quantity;
                }
            });

            document.getElementById("subtotal-text").innerText = `Subtotal: Rp${subtotal.toLocaleString()}`;
        }

        // Fungsi untuk mengubah jumlah item di keranjang
        function changeQuantity(index, change) {
            const cart = JSON.parse(localStorage.getItem("cart")) || [];
            const item = cart[index];

            item.quantity += change;
            if (item.quantity < 1) {
                item.quantity = 1;
            }

            document.getElementById(`quantity-${index}`).value = item.quantity;
            document.getElementById(`item-total-${index}`).innerText = `Rp${(item.price * item.quantity).toLocaleString()}`;

            localStorage.setItem("cart", JSON.stringify(cart));
            calculateSubtotal();
        }

        // Fungsi untuk menghapus item dari keranjang
        function removeFromCart(index) {
            const cart = JSON.parse(localStorage.getItem("cart")) || [];
            cart.splice(index, 1);
            localStorage.setItem("cart", JSON.stringify(cart));
            renderCartItems();
            calculateSubtotal();
        }

        // Inisialisasi saat halaman dimuat
        document.addEventListener("DOMContentLoaded", function() {
            renderCartItems();
        });
    </script>

</body>

</html>
