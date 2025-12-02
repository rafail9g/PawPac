<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PawPac Adopter')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: flex;
            background: linear-gradient(135deg, #fff5e6 0%, #ffe8c2 100%);
            margin: 0;
            font-family: 'Poppins', sans-serif;
            color: #4b2e14;
        }

        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #f8e6cc 0%, #ffe8c2 100%);
            color: #4b2e14;
            display: flex;
            flex-direction: column;
            padding-top: 20px;
            box-shadow: 4px 0 20px rgba(0,0,0,0.1);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-header {
            text-align: center;
            padding: 20px;
            border-bottom: 2px solid rgba(196, 138, 85, 0.2);
            margin-bottom: 20px;
        }

        .sidebar-logo {
            font-size: 36px;
            margin-bottom: 10px;
        }

        .sidebar h3 {
            font-size: 28px;
            font-weight: 700;
            color: #c48a55;
            margin-bottom: 5px;
        }

        .user-info {
            background: rgba(255, 255, 255, 0.6);
            padding: 15px;
            border-radius: 12px;
            margin: 0 15px 20px 15px;
            text-align: center;
            border: 2px solid rgba(196, 138, 85, 0.3);
        }

        .user-avatar {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #c48a55, #a16c3e);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-size: 28px;
            color: white;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
        }

        .user-name {
            font-weight: 600;
            color: #4b2e14;
            font-size: 16px;
        }

        .user-role {
            font-size: 13px;
            color: #8b6f4e;
            margin-top: 3px;
        }

        .nav-menu {
            padding: 0 15px;
            flex-grow: 1;
        }

        .nav-link {
            color: #4b2e14;
            text-decoration: none;
            padding: 14px 18px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
            border-radius: 12px;
            margin: 0 0 8px 0;
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: #c48a55;
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            background: linear-gradient(135deg, rgba(196, 138, 85, 0.2), rgba(255, 232, 194, 0.4));
            color: #c48a55;
            transform: translateX(5px);
        }

        .nav-link:hover::before,
        .nav-link.active::before {
            transform: scaleY(1);
        }

        .nav-link i {
            font-size: 20px;
            width: 24px;
            text-align: center;
        }

        .sidebar-footer {
            padding: 20px 15px;
            border-top: 2px solid rgba(196, 138, 85, 0.2);
            margin-top: auto;
        }

        .btn-logout {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            width: 100%;
        }

        .btn-logout:hover {
            background: linear-gradient(135deg, #c0392b, #a93226);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(231, 76, 60, 0.3);
            color: white;
        }

        .content {
            margin-left: 280px;
            flex-grow: 1;
            padding: 30px;
            background: transparent;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content-wrapper {
            flex-grow: 1;
        }

        footer {
            text-align: center;
            padding: 20px;
            color: #4b2e14;
            border-top: 2px solid rgba(196, 138, 85, 0.2);
            margin-top: auto;
            background: rgba(248, 230, 204, 0.6);
            font-size: 14px;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.05);
            border-radius: 12px;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.3);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #c48a55;
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: #a16c3e;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .content {
                margin-left: 0;
            }
        }
        .btn-feature {
            background: linear-gradient(135deg, #c48a55, #a16c3e);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-feature:hover {
            background: linear-gradient(135deg, #a16c3e, #8b5e34);
            transform: scale(1.05);
            color: white;
        }
    </style>

</head>

<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h3>PawPac</h3>
        </div>

        <div class="user-info">
            <div class="user-avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="user-name">{{ auth()->user()->name }}</div>
            <div class="user-role">Adopter</div>
        </div>

        <div class="nav-menu">
            <a href="{{ route('adopter.dashboard') }}"
               class="nav-link {{ request()->routeIs('adopter.dashboard') ? 'active' : '' }}">
                <i class="bi bi-house-door-fill"></i>
                <span>Halaman Utama</span>
            </a>

            <a href="{{ route('adopter.materi') }}"
               class="nav-link {{ request()->routeIs('adopter.materi') ? 'active' : '' }}">
                <i class="bi bi-book-fill"></i>
                <span>Materi Edukasi</span>
            </a>

            <a href="{{ route('adopter.pilih') }}"
               class="nav-link {{ request()->routeIs('adopter.pilih') ? 'active' : '' }}">
                <i class="bi bi-clipboard-check-fill"></i>
                <span>Tes Adopsi</span>
            </a>

            <a href="{{ route('adopter.status') }}"
               class="nav-link {{ request()->routeIs('adopter.status') ? 'active' : '' }}">
                <i class="bi bi-clock-history"></i>
                <span>History Tes</span>
            </a>

            <a href="{{ route('adopter.profile') }}"
               class="nav-link {{ request()->routeIs('adopter.profile') ? 'active' : '' }}">
                <i class="bi bi-person-circle"></i>
                <span>Edit Profil</span>
            </a>
        </div>

        <div class="sidebar-footer">
            <a href="{{ route('logout') }}" class="btn-logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>

    <div class="content">
        <div class="content-wrapper">
            @yield('content')
        </div>

        <footer>
            <strong>&copy; 2025 PawPac</strong><br>
            <small>Sistem Dokumentasi & Adopsi Hewan</small>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
