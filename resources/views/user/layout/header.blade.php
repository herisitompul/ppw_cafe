<header class="header">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="logo d-flex align-items-center">
            <img src="{{ asset('logo/logo.png') }}" alt="delCafe Logo" class="logo-img">
        </div>

        <nav class="nav">
            <a href="{{ route('user.dashboard') }}" class="nav-link">Beranda</a>
            <a href="{{ route('pesanan.saya') }}" class="nav-link">Pesanan saya</a>
        </nav>

        <div class="icons d-flex align-items-center">
            <!-- Search Bar -->
            <div class="search-box">
                <form action="{{ route('product.search') }}" method="GET" style="display: flex; width: 100%;">
                    <input type="text" name="search" placeholder="Cari produk..." required>
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>

            <a href="{{ route('keranjang.index') }}" class="cart-icon">
                <button class="btn" id="cart"><i class="fas fa-shopping-cart"
                        style="font-size: 25px;"></i>{{ $cartCount }}</button>
            </a>

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
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
