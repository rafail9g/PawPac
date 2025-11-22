<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PawPac Adopter')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            background-color: #fffaf2;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            color: #4b2e14;
        }

        .sidebar {
            width: 250px;
            background-color: #f8e6cc;
            color: #4b2e14;
            display: flex;
            flex-direction: column;
            padding-top: 20px;
            box-shadow: 2px 0 6px rgba(0,0,0,0.1);
        }

        .sidebar h3 {
            text-align: center;
            margin-bottom: 30px;
            color: #4b2e14;
        }

        .sidebar a {
            color: #4b2e14;
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            transition: background 0.3s, color 0.3s;
            border-radius: 8px;
            margin: 0 10px 6px 10px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #c48a55;
            color: #fff;
        }

        .content {
            flex-grow: 1;
            padding: 30px;
            background-color: #fffaf2;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        footer {
            text-align: center;
            padding: 12px;
            color: #4b2e14;
            border-top: 1px solid #e0c9a6;
            margin-top: auto;
            background-color: #f8e6cc;
            font-size: 14px;
            box-shadow: 0 -2px 6px rgba(0,0,0,0.05);
        }
    </style>

</head>

<body>
    <div class="sidebar">
        <h3>PawPac</h3>
        <p class="text-center small mb-3">Halo, {{ auth()->user()->name ?? 'Adopter' }}</p>

        <a href="{{ route('adopter.dashboard') }}"
           class="{{ request()->routeIs('adopter.dashboard') ? 'active' : '' }}">
           Halaman Utama
        </a>

        <a href="{{ route('adopter.pilih') }}"
        class="{{ request()->routeIs('adopter.pilihkucing') ? 'active' : '' }}">
        Test
        </a>

        <a href="{{ route('adopter.status') }}"
        class="{{ request()->routeIs('adopter.') ? 'active' : '' }}">
        History Test
        </a>
        <div class="mt-auto">
            <a href="{{ route('logout') }}" class="text-danger">Logout</a>
        </div>
    </div>

    <div class="content">
        @yield('content')

        <footer>
            <small>&copy; 2025 CatAdopt & Care — Dashboard Adopter</small>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
