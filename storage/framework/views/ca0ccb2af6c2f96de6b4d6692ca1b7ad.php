

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Del Cafe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
            <div class="login-text">
                <h2>Welcome to</h2>
                    <h1>DEL CAFE</h1>
            </div>
        <div class="login-container">
        <div class="login-form">
            <form method="POST" action="<?php echo e(route('register')); ?>">
                <?php echo csrf_field(); ?>
            <h2>Join us</h2>
            <h3>Create a Del Cafe Account</h3><br>
            <input type="text" name="name" class="form-control" placeholder="Full Name" required>
            <input type="email" name="email" class="form-control" placeholder="Email" required>
            <input type="password" name="password" class="form-control" placeholder="Your password" required>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password" required>
            <button type="submit" class="btn btn-login">Sign Up</button>
        </form>
            <div class="divider">
                <span>or</span>
            </div>
            <div class="login-footer">
                <p>Already have an account? <a href="<?php echo e(route('login')); ?>">Login</a></p>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH D:\laragon\www\del_cafe\resources\views/auth/register.blade.php ENDPATH**/ ?>