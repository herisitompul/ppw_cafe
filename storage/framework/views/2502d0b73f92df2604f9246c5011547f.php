<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Kategori - DelCafe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?php echo e(asset('css/kategori.css')); ?>">
    <script defer src="https://use.fontawesome.com/releases/v5.8.1/js/all.js"></script>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Logo and Brand Name -->
            <div class="logo d-flex align-items-center">
                <img src="<?php echo e(asset('logo/logo.png')); ?>" alt="delCafe Logo" class="logo-img">
            </div>

            <!-- Navigation Menu -->
            <nav class="nav">
                <a href="<?php echo e(route('user.dashboard')); ?>" class="nav-link">Beranda</a>
                <a href="#" class="nav-link">Pesanan saya</a>
            </nav>

            <!-- Search, Cart, and User Icon -->
            <div class="icons d-flex align-items-center">
                <!-- Search Bar -->
                <div class="search-box">
                    <form action="<?php echo e(route('product.search')); ?>" method="GET">
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
                        <span class="user-initial"><?php echo e(strtoupper(auth()->user()->name[0])); ?></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <div class="dropdown-header">
                            <strong><?php echo e(auth()->user()->name); ?></strong><br>
                            <small><?php echo e(auth()->user()->email); ?></small><br>
                        </div>
                        <a class="dropdown-item" href="#">Pesanan saya</a>
                        <hr>
                        <!-- logout -->
                        <form action="<?php echo e(route('logout')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="dropdown-item">Keluar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </header>

    <!-- -------- -->
    

    <!-- Gaya tambahan di dalam tag <style> -->
    

    <!-- Layout HTML yang telah diperbaiki -->
    

    <!-- Layout HTML dengan gambar yang melebar penuh -->
    <!-- Layout HTML dengan gambar yang melebar penuh ke ujung layar -->
    <!-- Banner Image -->
    <div class="image-produk my-2" style="width: 100%; margin: 0; padding: 0; overflow: hidden;">
        <img src="<?php echo e(asset('kategoris/' . $kategori->gambar)); ?>" class="img-fluid"
            style="width: 100vw; height: 400px; object-fit: cover; object-position: center;" alt="Gambar Kategori">
    </div>

    <div class="text-kategory" style="margin-left: 550px; margin-top: 50px; margin-bottom: 20px;">
        <h3><?php echo e($kategori->nama); ?></h3>
    </div>

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
                                <!-- deskripsi -->
                                <p class="card-text"><?php echo e(Str::limit($produk->deskripsi, 50)); ?></p>
                                <!-- harga -->
                                <p class="card-text-price">Rp <?php echo e(number_format($produk->harga, 0, ',', '.')); ?></p>
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
</body>

</html>
<?php /**PATH D:\laragon\www\ppw_cafe\resources\views/user/kategori.blade.php ENDPATH**/ ?>