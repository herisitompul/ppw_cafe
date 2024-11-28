

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Del Cafe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body>
            <div class="login-text">
                <h2>Welcome to</h2>
                    <h1>DEL CAFE</h1>
            </div>
        <div class="login-container">
        <div class="login-form">
            <form method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo csrf_field(); ?>
            <h2>Welcome Back!</h2>
            <h3>Login to your Account</h3><br>
                
                <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                <input type="password" id="password" name="password" class="form-control" placeholder="Your password" required>
                <button type="submit" class="btn btn-login">Log In</button>
            </form>
            <div class="divider">
                <span>or</span>
            </div>
            <div class="login-footer">
                <p>Don't have an account? <a href="<?php echo e(route('register')); ?>">Sign Up</a></p>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH D:\laragon\www\del_cafe\resources\views/auth/login.blade.php ENDPATH**/ ?>