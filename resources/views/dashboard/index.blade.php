{{-- @extends('Admin.layout.main')
@section('content')
@if ($message = Session::get('success'))
	  <div class="alert alert-success alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>
		  <strong>{{ $message }}</strong>
	  </div>
	@endif

	@if ($message = Session::get('error'))
	  <div class="alert alert-danger alert-block">
	    <button type="button" class="close" data-dismiss="alert">×</button>
		<strong>{{ $message }}</strong>
	  </div>
	@endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col" style="width: 10px">No</th>
                <th scope="col">Judul</th>
                <th scope="col">Harga</th>
                <th scope="col">Deskripsi</th>
                <th scope="col" style="width: 30px">Gambar</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produk as $index => $produk )
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $produk->judul }}</td>
                <td>{{ $produk->harga }}</td>
                <td>{{ $produk->deskripsi }}</td>
                <td><img src="{{ asset('gambar/' . $produk->gambar) }}" alt="" style="width: 150px"></td>
                <td>
                <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" style="display: inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>

                @endforeach
        </tbody>
    </table>
@endsection --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
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

        <!-- ------------ -->
        <div id="carouselExampleIndicators" class="carousel slide mx-2 my-2" data-ride="carousel">
            <!-- <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol> -->
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="slide/slide1.png" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="slide/slide2.png" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="slide/slide3.png" alt="Third slide">
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
                <!-- Makanan -->
                <div class="culinary-item mx-3">
                    <a href="kategori.html">
                    <img src="kategori/makanan.png" class="rounded-circle" alt="Makanan" width="130">
                </a>
                    <p>Makanan</p>
                </div>

                <!-- Snack -->
                <div class="culinary-item mx-3">
                    <a href="#">
                    <img src="kategori/makanan.png" class="rounded-circle" alt="Snack" width="130">
                </a>
                    <p>Snack</p>
                </div>

                <!-- Minuman -->
                <div class="culinary-item mx-3">
                    <a href="#">
                    <img src="kategori/makanan.png" class="rounded-circle" alt="Minuman" width="130">
                </a>
                    <p>Minuman</p>
                </div>
            </div>
        </section>

        <h2 class="text-center mb-3">Apa aja nih yang enak di DelCafe?</h2>
        <!-- ------ -->
         <section>
        <div class="d-flex justify-content-center" style="margin-bottom: 10%;">
        <div class="card" style="width: 15rem; margin-right: 14px;">
            <a href="#">
            <img src="produk/bakwan.png" class="card-img-top mt-2" alt="..." style="width: 90%; display: block; margin: 0 auto;">
        </a>
            <div class="card-body">
              <p class="card-text" style="font-weight: bold; font-size: 20px; margin-bottom: 3px;">Bakwan saus kacang</p>
              <!-- deskripsi -->
               <p class="card-text">Wortel, kubis, kacang</p>
               <!-- harga -->
                <p class="card-text">Rp 15.000</p>
            </div>
          </div>
          <div class="card" style="width: 15rem; margin-right: 14px;">
            <a href="#">
            <img src="produk/bakwan.png" class="card-img-top mt-2" alt="..." style="width: 90%; display: block; margin: 0 auto;">
        </a>
            <div class="card-body">
              <p class="card-text">Bakwan saus kacang</p>
            </div>
          </div>
          <div class="card" style="width: 15rem; margin-right: 14px;">
            <img src="produk/bakwan.png" class="card-img-top mt-2" alt="..." style="width: 90%; display: block; margin: 0 auto;">
            <div class="card-body">
              <p class="card-text">Bakwan saus kacang</p>
            </div>
          </div>
          <div class="card" style="width: 15rem; margin-right: 14px;">
            <img src="produk/bakwan.png" class="card-img-top mt-2" alt="..." style="width: 90%; display: block; margin: 0 auto;">
            <div class="card-body">
              <p class="card-text">Bakwan saus kacang</p>
            </div>
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

</body>
</html>
