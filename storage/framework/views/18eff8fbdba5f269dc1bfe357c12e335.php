<!DOCTYPE html>
<html lang="en">
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
    
    <div class="container text-center mt-5">
        <h3>Pesanan Anda Berhasil!</h3>
        <p>Pesanan Anda sedang diproses.</p>
        <a href="<?php echo e(route('user.dashboard')); ?>" class="btn btn-primary">Kembali ke Beranda</a>
    </div>

</body>
</html>

<?php /**PATH D:\laragon\www\ppw_cafe\resources\views/payment/success.blade.php ENDPATH**/ ?>