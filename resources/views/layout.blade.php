<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CatAdopt & Care')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            background-color: #f8f9fa;
            margin: 0;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: white;
            display: flex;
            flex-direction: column;
            padding-top: 20px;
        }
        .sidebar h3 {
            text-align: center;
            margin-bottom: 30px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            transition: background 0.2s;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #495057;
        }
        .content {
            flex-grow: 1;
            padding: 30px;
        }
        footer {
            text-align: center;
            padding: 10px;
            color: #777;
            border-top: 1px solid #ddd;
            margin-top: 40px;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h3>CatAdopt & Care</h3>
        <p class="text-center small mb-3">Halo, {{ auth()->user()->name ?? 'Admin' }}</p>
        <a href="{{ route('admin.dashboard') }}" class="active">🐾 Halaman Utama</a>
        <a href="{{ route('admin.adopter.index') }}" class="active">🐾 Data Adopter</a>
        <div class="mt-auto">
            <a href="{{ route('logout') }}" class="text-danger">🚪 Logout</a>
        </div>
    </div>

    <div class="content">
        @yield('content')

        <footer>
            <small>&copy; 2025 CatAdopt & Care. Semua hak dilindungi.</small>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
