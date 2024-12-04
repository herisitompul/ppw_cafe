<!-- resources/views/User/layout/main.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <!-- Include Header for User Dashboard -->
        @include('User.partials.header')
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <!-- Include Footer for User Dashboard -->
        @include('User.partials.footer')
    </footer>
</body>
</html>
