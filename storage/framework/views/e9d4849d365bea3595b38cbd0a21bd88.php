<header class="header">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="logo d-flex align-items-center">
            <img src="<?php echo e(asset('logo/logo.png')); ?>" alt="delCafe Logo" class="logo-img">
        </div>

        <nav class="nav">
            <a href="<?php echo e(route('user.dashboard')); ?>" class="nav-link">Beranda</a>
            <a href="#" class="nav-link">Pesanan saya</a>
        </nav>

        <div class="icons d-flex align-items-center">
            <div class="search-box">
                <input type="text" placeholder="Search...">
                <button type="submit"><i class="fas fa-search"></i></button>
            </div>

            <a href="<?php echo e(route('keranjang.index')); ?>" class="cart-icon">
                <button class="btn" id="cart"><i class="fas fa-shopping-cart"
                        style="font-size: 25px;"></i><?php echo e($cartCount); ?></button>
            </a>

            <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cartModalLabel">Keranjang Anda</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
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
                    <form action="<?php echo e(route('logout')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="dropdown-item">Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
<?php /**PATH D:\laragon\www\ppw_cafe\resources\views/user/layout/header.blade.php ENDPATH**/ ?>