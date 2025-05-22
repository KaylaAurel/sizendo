<!-- resources/views/layouts/auth.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Auth</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex">
        @auth
            @include('partials.sidebar')
        @endauth

        <div class="flex-grow-1 p-4">
            @yield('content')
        </div>
    </div>
</body>
</html>
