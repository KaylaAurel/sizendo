<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            min-height: 100vh;
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: white;
        }
        .sidebar a {
            color: white;
            display: block;
            padding: 15px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            flex: 1;
            padding: 30px;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4 class="text-center py-3">Admin Panel</h4>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.member.index') }}">Daftar Member</a>
        <a href="{{ route('admin.paket.index') }}">Manajemen Paket</a>
        <a href="{{ route('admin.testimonial.index') }}">Testimonial</a>
        <a href="{{ route('admin.pengaturan.index') }}">Pengaturan</a>
        <form action="{{ route('admin.logout') }}" method="POST" class="mt-4 text-center">
            @csrf
            <button class="btn btn-danger">Logout</button>
        </form>
    </div>
    <div class="content">
        @yield('content')
    </div>
</body>
</html>
