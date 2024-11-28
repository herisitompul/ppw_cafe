<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <style>
        body {
            background: linear-gradient(135deg, #6dd5ed, #2193b0);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1s ease-out;
        }

        .card-header h2 {
            color: #fff;
            background-color: #2193b0;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            padding: 15px 0;
        }

        .card-body {
            padding: 2rem;
            background: #fff;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
        }

        .form-control:focus {
            border-color: #2193b0;
            box-shadow: 0 0 8px rgba(33, 147, 176, 0.8);
            transition: all 0.3s;
        }

        .btn {
            background-color: #2193b0;
            color: #fff;
            transition: background-color 0.4s ease;
        }

        .btn:hover {
            background-color: #6dd5ed;
            color: #fff;
        }

        /* Error styles */
        .alert {
            font-size: 14px;
            padding: 10px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <div class="container w-50">
        <div class="card">
            <div class="card-header text-center">
                <h2>Form Admin Login</h2>
            </div>
            <div class="card-body">
                <!-- Error Alert -->
                <?php if(Session::has('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo e(Session::get('error')); ?>

                    </div>
                <?php endif; ?>
                <!-- Login Form -->
                <form action="<?php echo e(route('admin.login')); ?>" method="POST" id="loginForm">
                    <?php echo csrf_field(); ?>
                    <div class="form-group mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Masukkan Username">
                        <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="div alert alert-danger mt-2"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Masukkan password">
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="div alert alert-danger mt-2"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <button type="submit" class="btn w-100 btn-info" id="submitButton">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        <span class="button-text">Login</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('loginForm').addEventListener('submit', function(event) {
                var submitButton = document.getElementById('submitButton');
                var spinner = submitButton.querySelector('.spinner-border');
                var buttonText = submitButton.querySelector('.button-text');

                spinner.classList.remove('d-none');
                buttonText.textContent = 'Loading...';

                submitButton.disabled = true;
            });
        });
    </script>
</body>

</html>
<?php /**PATH D:\laragon\www\ppw_cafe\resources\views/Admin/Login.blade.php ENDPATH**/ ?>