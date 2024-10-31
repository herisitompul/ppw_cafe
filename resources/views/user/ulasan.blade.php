<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Styled Web Page</title>
    <link rel="stylesheet" href="{{ asset('css/ulasan.css') }}">

</head>
<body>

   
    <div class="header">
        <div class="left-section">
            <div class="logo">
                <img src="Image/logo.png" alt="Logo delCafe"> 
            </div>
            <div class="menu">
                <a href="#">Beranda</a>
                <a href="#">Pesanan saya</a>
            </div>
            <!-- Search Box -->
            <div class="search-box">
                <input type="text" placeholder="Cari menu...">
                <i class="fa fa-search icon" aria-hidden="true"></i> 
            </div>
        </div>
        <div class="right-section">
            <i class="fa fa-shopping-basket icon" aria-hidden="true"></i>
            <i class="fa fa-user icon" aria-hidden="true"></i> 
        </div>
    </div>

    <!-- Image Section -->
    <div class="image-section">
        <img src="Image/bakwan.png" alt="Bakwan Saus Kacang">
    </div>

    <!-- Product Info -->
    <div class="product-info">
        <h2>Bakwan Saus Kacang</h2>
    </div>

    <div class="review-section">
        <textarea placeholder="Berikan ulasan anda ..."></textarea>
        <button>Submit</button>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="contact-info">
            <h6>
                <strong style="font-size: 14px; border-bottom: 2px solid white;">Contact Us</strong><br>
                Find your food here!<br>
                <i class="fa fa-envelope" aria-hidden="true"></i> delcafe@gmail.com<br>
                <i class="fa fa-phone" aria-hidden="true"></i> +628123456789
            </h6>
        </div>
        <div class="logo">
            <img src="Image/Frame3.png" alt="Frame 3">
            <strong>delCafe</strong>
        </div>
    </div>

<script defer src="https://use.fontawesome.com/releases/v5.8.1/js/all.js" integrity="sha384-g5uSoOSBd7KkhAMlnQILrecXvzst9TdC09/VM+pjDTCM+1il8RHz5fKANTFFb+gQ" crossorigin="anonymous"></script>
</body>
</html>
