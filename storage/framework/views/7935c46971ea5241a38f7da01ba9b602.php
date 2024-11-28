<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - DelCafe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?php echo e(asset('css/dashboard.css')); ?>">
    <script defer src="https://use.fontawesome.com/releases/v5.8.1/js/all.js"></script>
</head>

<body>
    <!-- Header -->
    
    <?php echo $__env->make('user.layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Product Section -->
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-6">
                <img src="<?php echo e(asset('gambar/' . $produk->gambar)); ?>" alt="Bakwan Saus Kacang" class="product-image"
                    style="border-radius: 10px">
                
            </div>
            <div class="col-md-6 product-detail">
                <h3><?php echo e($produk->judul); ?></h3>
                <h4>Rp <?php echo e(number_format($produk->harga, 0, ',', '.')); ?></h4>
                <p><?php echo e($produk->deskripsi); ?></p>
                <p><strong>Stok: <?php echo e($produk->stok); ?></strong></p>
                
                <form action="<?php echo e(route('add.cart')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="produk_id" value="<?php echo e($produk->id); ?>">
                    <label class="mb-2" for="quantity_<?php echo e($produk->id); ?>"><strong>Kuantitas:</strong></label>
                    <div class="d-flex align-items-center mb-3">
                        <button class="btn btn-outline-secondary" type="button"
                            onclick="decreaseQuantity(<?php echo e($produk->id); ?>, <?php echo e($produk->stok); ?>)">-</button>
                        <input type="text" id="quantity_<?php echo e($produk->id); ?>" name="kuantitas"
                            class="form-control text-center mx-2" value="1" style="width: 50px;" readonly>
                        <button class="btn btn-outline-secondary" type="button"
                            onclick="increaseQuantity(<?php echo e($produk->id); ?>, <?php echo e($produk->stok); ?>)">+</button>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-secondary mr-2">Masukkan Keranjang</button>
                </form>
                
                <input type="hidden" name="produk_id" value="<?php echo e($produk->id); ?>">
                <input type="hidden" name="quantity" id="quantity-input" value="1">
                
                <button id="pay-button" class="btn btn-success mx-2">Beli Sekarang</button>
                <script>
                    document.getElementById('pay-button').onclick = function() {
                        // Kirim request ke backend untuk mendapatkan snap token
                        fetch('<?php echo e(route('payment.snap')); ?>', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                                },
                                body: JSON.stringify({
                                    amount: 10000, // Contoh total harga
                                    product_id: 1, // ID produk
                                    product_name: 'Bakwan Saus Kacang',
                                    price: 10000,
                                    quantity: 1,
                                }),
                            })
                            .then(response => response.json())
                            .then(data => {
                                // Tampilkan Snap UI
                                snap.pay(data.snap_token, {
                                    onSuccess: function(result) {
                                        alert("Pembayaran berhasil!");
                                        console.log(result);
                                    },
                                    onPending: function(result) {
                                        alert("Menunggu pembayaran!");
                                        console.log(result);
                                    },
                                    onError: function(result) {
                                        alert("Pembayaran gagal!");
                                        console.log(result);
                                    }
                                });
                            });
                    };
                </script>
                <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo e(env('MIDTRANS_CLIENT_KEY')); ?>">
                </script>

                

                
            </div>
            <p>Kategori: <?php echo e($produk->kategori->nama); ?></p>
        </div>
    </div>
    </div><br>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="<?php echo e(env('MIDTRANS_CLIENT_KEY')); ?>"></script>


    <h2 class="text-center mb-3">Kamu mungkin juga suka</h2>
    <section>
        <div class="container">
            <div class="row">
                <?php $__currentLoopData = $produks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4 col-lg-3 mb-4">
                        <div class="card h-100" style="width: 100%">
                            <a href="<?php echo e(route('user.show', $produk->id)); ?>">
                                <img src="<?php echo e(asset('gambar/' . $produk->gambar)); ?>" class="card-img-top mt-2"
                                    alt="..." style="width: 90%; display: block; margin: 0 auto;">
                            </a>
                            <div class="card-body">
                                <p class="card-text" style="font-weight: bold; font-size: 20px; margin-bottom: 3px;">
                                    <?php echo e($produk->judul); ?></p>
                                <p class="card-text"><?php echo e(Str::limit($produk->deskripsi, 50)); ?></p>
                                <p class="card-text">Rp <?php echo e(number_format($produk->harga, 0, ',', '.')); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                    
                    <a href="https://wa.me/6287844043032" target="_blank" class="whatsapp-link">
                        <i class="fab fa-whatsapp"></i> +628123456789
                    </a>
                </p>
            </div>
            <div class="footer-right">
                <img src="<?php echo e(asset('logo/icon 1.png')); ?>" alt="delCafe Logo" class="footer-logo"
                    style="margin-right: 15px;">
                <h2>delCafe</h2>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        // Fungsi untuk menambahkan item ke keranjang
        function addToCart() {
            const product = {
                id: <?php echo e($produk->id); ?>,
                name: "<?php echo e($produk->judul); ?>",
                price: <?php echo e($produk->harga); ?>,
                image: "<?php echo e(asset('gambar/' . $produk->gambar)); ?>",
                quantity: parseInt(document.getElementById('quantity').value)
            };

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

            // Update jumlah item di cart icon dan render cart
            updateCartCount();
            renderCartItems();
        }

        // Fungsi untuk memperbarui jumlah item di ikon cart
        function updateCartCount() {
            const cart = JSON.parse(localStorage.getItem("cart")) || [];
            const totalQuantity = cart.reduce((sum, item) => sum + item.quantity, 0);
            document.getElementById("cart-count").innerText = totalQuantity;
        }

        // Fungsi untuk menampilkan isi keranjang di dalam modal
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

            calculateSubtotal(); // Recalculate the subtotal after rendering items
        }

        // Fungsi untuk menghitung subtotal berdasarkan checkbox
        function calculateSubtotal() {
            const cart = JSON.parse(localStorage.getItem("cart")) || [];
            let subtotal = 0;
            document.querySelectorAll('.item-checkbox').forEach((checkbox, index) => {
                if (checkbox.checked) {
                    const item = cart[index];
                    subtotal += item.price * item.quantity;
                }
            });
            document.getElementById("subtotal-text").innerText = `Subtotal: Rp${subtotal.toLocaleString()}`;
        }

        // Fungsi untuk mengubah jumlah item di keranjang
        function changeQuantity(index, delta) {
            const cart = JSON.parse(localStorage.getItem("cart"));
            cart[index].quantity += delta;
            if (cart[index].quantity < 1) cart[index].quantity = 1;
            localStorage.setItem("cart", JSON.stringify(cart));
            renderCartItems();
            updateCartCount();
        }

        // Fungsi untuk menghapus item dari keranjang
        function removeFromCart(index) {
            const cart = JSON.parse(localStorage.getItem("cart"));
            cart.splice(index, 1);
            localStorage.setItem("cart", JSON.stringify(cart));
            renderCartItems();
            updateCartCount();
        }

        // Inisialisasi halaman
        document.addEventListener("DOMContentLoaded", function() {
            updateCartCount(); // Update jumlah cart pada ikon
            renderCartItems(); // Render item dalam keranjang ketika halaman dimuat
        });

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php if(session('success')): ?>
        <script>
            Swal.fire({
                title: "Berhasil Memasukkan Produk ke Keranjang",
                text: "Tekan Ok!",
                icon: "success"
            });
        </script>
    <?php endif; ?>
</body>

</html>
<?php /**PATH D:\laragon\www\ppw_cafe\resources\views/user/show.blade.php ENDPATH**/ ?>