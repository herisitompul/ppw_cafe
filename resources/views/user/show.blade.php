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
    @include('user.layout.header')

    <!-- Product Section -->
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('gambar/' . $produk->gambar) }}" alt="Bakwan Saus Kacang" class="product-image"
                    style="border-radius: 10px">
                {{-- <div class="d-flex mt-3" style="margin-left: 145px;">
                    <img src="{{ asset('gambar/' . $produk->gambar) }}" alt="Thumbnail 1" class="thumbnail-image">
                    <img src="produk/bakwan.png" alt="Thumbnail 2" class="thumbnail-image">
                    <img src="produk/bakwan.png" alt="Thumbnail 3" class="thumbnail-image">
                </div> --}}
            </div>
            <div class="col-md-6 product-detail">
                <h3>{{ $produk->judul }}</h3>
                <h4>Rp {{ number_format($produk->harga, 0, ',', '.') }}</h4>
                <p>{{ $produk->deskripsi }}</p>
                <p><strong>Stok: {{ $produk->stok }}</strong></p>
                {{-- <p><strong>Kuantitas:</strong></p> --}}
                <form action="{{ route('add.cart') }}" method="POST">
                    @csrf
                    <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                    <input type="hidden" name="quantity" id="quantity-input" value="1">
                    <label class="mb-2" for="quantity_{{ $produk->id }}"><strong>Kuantitas:</strong></label>
                    <div class="d-flex align-items-center mb-3">
                        <button class="btn btn-outline-secondary" type="button"
                            onclick="decreaseQuantity({{ $produk->id }}, {{ $produk->stok }})">-</button>
                        <input type="text" id="quantity_{{ $produk->id }}" name="kuantitas"
                            class="form-control text-center mx-2" value="1" style="width: 50px;" readonly>
                        <button class="btn btn-outline-secondary" type="button"
                            onclick="increaseQuantity({{ $produk->id }}, {{ $produk->stok }})">+</button>
                    </div>
                    <div class="mb-3">
                        {{-- <button type="submit" class="btn btn-secondary mr-2">Masukkan Keranjang</button> --}}
                        <p>Kategori: {{ $produk->kategori->nama }}</p>
                        <button type="submit" class="btn btn-success mr-2">Masukkan Ke Keranjang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div><br>

    <h2 class="text-center mb-3">Kamu mungkin juga suka</h2>
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
        // Fungsi untuk menambah atau mengurangi jumlah kuantitas
        function increaseQuantity(produk_id, stok) {
            const quantityInput = document.getElementById(`quantity_${produk_id}`);
            let currentQuantity = parseInt(quantityInput.value);
            if (currentQuantity < stok) {
                quantityInput.value = currentQuantity + 1;
            }
        }

        function decreaseQuantity(produk_id, stok) {
            const quantityInput = document.getElementById(`quantity_${produk_id}`);
            let currentQuantity = parseInt(quantityInput.value);
            if (currentQuantity > 1) {
                quantityInput.value = currentQuantity - 1;
            }
        }
    </script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                title: "Berhasil Memasukkan Produk ke Keranjang",
                text: "Tekan Ok!",
                icon: "success"
            });
        </script>
    @endif --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                title: "{{ session('success') }}",
                text: "Lanjutkan ke pembayaran!",
                icon: "success"
            });
        </script>
    @endif

</body>

</html>
