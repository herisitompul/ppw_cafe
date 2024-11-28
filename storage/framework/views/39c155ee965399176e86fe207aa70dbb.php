<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - DelCafe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/dashboard.css')); ?>">
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
                    <img src="<?php echo e(asset('logo/logo.png')); ?>"  alt="delCafe Logo" class="logo-img">
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
                            <span class="user-initial"><?php echo e(strtoupper(auth()->user()->name[0])); ?></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <div class="dropdown-header">
                                <strong><?php echo e(auth()->user()->name); ?></strong><br>
                                <small><?php echo e(auth()->user()->email); ?></small><br>
                            </div>
                            <a class="dropdown-item" href="#">Pesanan saya</a><hr>
                            <!-- logout -->
                            <form action="<?php echo e(route('logout')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
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
                        <img src="<?php echo e(asset('gambar/' . $produk->gambar)); ?>" alt="Bakwan Saus Kacang" class="product-image" height="400" width="600" style="border-radius: 10px"/>
                        <div class="d-flex mt-3" style="margin-left: 145px;">
                            <img src="<?php echo e(asset('gambar/' . $produk->gambar)); ?>" alt="Thumbnail 1" class="thumbnail-image">
                            <img src="produk/bakwan.png" alt="Thumbnail 2" class="thumbnail-image">
                            <img src="produk/bakwan.png" alt="Thumbnail 3" class="thumbnail-image">
                        </div>
                    </div>
                        <div class="col-md-6 product-detail">
                            <h3><?php echo e($produk->judul); ?></h3>
                            <h4>Rp <?php echo e(number_format($produk->harga, 0, ',', '.')); ?></h4>
                            <p><?php echo e($produk->deskripsi); ?></p>
                            <p><strong>Kuantitas:</strong></p>
                            <div class="d-flex align-items-center mb-3">
                                <button class="btn btn-outline-secondary">-</button>
                                <input type="text" class="form-control text-center mx-2" value="1" style="width: 50px;">
                                <button class="btn btn-outline-secondary">+</button>
                            </div>
                            <p><strong>Stok: <?php echo e($produk->stok); ?></strong></p>
                            <div class="d-flex mb-3">
                                <button class="btn btn-secondary mr-2">Masukkan Keranjang</button>
                                <button class="btn btn-success mx-2">Beli Sekarang</button>
                            </div>
                            <p>Kategori: <?php echo e($produk->kategori->nama); ?></p>
                        </div>
                        </div>
                        </div><br>
                    
             
            <h2 class="text-center mb-3">Kamu mungkin juga suka</h2>
            
            <section>
                <div class="container">
                    <div class="row">
                        <?php $__currentLoopData = $produks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4 col-lg-3 mb-4">
                            <div class="card h-100" style="width: 100%">
                                <a href="<?php echo e(route('user.show', $produk->id)); ?>">
                                    <img src="<?php echo e(asset('gambar/' . $produk->gambar)); ?>" class="card-img-top mt-2" alt="..." style="width: 90%; display: block; margin: 0 auto;">
                                </a>
                                <div class="card-body">
                                    <p class="card-text" style="font-weight: bold; font-size: 20px; margin-bottom: 3px;"><?php echo e($produk->judul); ?></p>
                                    <!-- deskripsi -->
                                    <p class="card-text"><?php echo e(Str::limit($produk->deskripsi, 50)); ?></p>
                                    <!-- harga -->
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
                <p><i class="fa fa-phone"></i> +628123456789</p>
            </div>
            <div class="footer-right">
                <img src="<?php echo e(asset('logo/icon 1.png')); ?>" alt="delCafe Logo" class="footer-logo" style="margin-right: 15px;">
                <h2>delCafe</h2>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH D:\laragon\www\del_cafe\resources\views/user/show.blade.php ENDPATH**/ ?>