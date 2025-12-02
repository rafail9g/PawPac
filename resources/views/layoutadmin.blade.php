<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PawPac Admin')</title>
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            font-family: 'Poppins', sans-serif;
            color: #2c3e50;
        }

        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
            color: white;
            display: flex;
            flex-direction: column;
            padding-top: 20px;
            box-shadow: 4px 0 20px rgba(0,0,0,0.3);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-header {
            text-align: center;
            padding: 20px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }

        .sidebar-logo {
            font-size: 36px;
            margin-bottom: 10px;
        }

        .sidebar h3 {
            font-size: 28px;
            font-weight: 700;
            color: white;
            margin-bottom: 5px;
        }

        .admin-badge {
            background: linear-gradient(135deg, #f39c12, #e67e22);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            margin-top: 5px;
        }

        .user-info {
            background: rgba(255, 255, 255, 0.1);
            padding: 15px;
            border-radius: 12px;
            margin: 0 15px 20px 15px;
            text-align: center;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .user-avatar {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #f39c12, #e67e22);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-size: 28px;
            color: white;
            box-shadow: 0 3px 10px rgba(0,0,0,0.3);
        }

        .user-name {
            font-weight: 600;
            color: white;
            font-size: 16px;
        }

        .user-role {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.7);
            margin-top: 3px;
        }

        .nav-menu {
            padding: 0 15px;
            flex-grow: 1;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8);
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
            background: #f39c12;
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            background: rgba(255, 255, 255, 0.15);
            color: white;
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
            border-top: 2px solid rgba(255, 255, 255, 0.1);
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
            box-shadow: 0 4px 12px rgba(231, 76, 60, 0.5);
            color: white;
        }

        .content {
            margin-left: 280px;
            flex-grow: 1;
            padding: 30px;
            background: #ecf0f1;
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
            color: #2c3e50;
            border-top: 2px solid #bdc3c7;
            margin-top: auto;
            background: white;
            font-size: 14px;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.05);
            border-radius: 12px;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #f39c12;
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: #e67e22;
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
    </style>

</head>

<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h3>PawPac</h3>
            <span class="admin-badge">ADMINISTRATOR</span>
        </div>

        <div class="user-info">
            <div class="user-avatar">
                {{ strtoupper(substr(auth()->user()->name ?? 'Admin', 0, 1)) }}
            </div>
            <div class="user-name">{{ auth()->user()->name ?? 'Admin' }}</div>
            <div class="user-role">Administrator</div>
        </div>

        <div class="nav-menu">
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.adopter.index') }}"
               class="nav-link {{ request()->routeIs('admin.adopter.*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i>
                <span>Data Adopter</span>
            </a>

            <a href="{{ route('admin.materi.index') }}"
               class="nav-link {{ request()->routeIs('admin.materi.*') ? 'active' : '' }}">
                <i class="bi bi-book-fill"></i>
                <span>Data Materi</span>
            </a>

            <a href="{{ route('admin.quiz.index') }}"
               class="nav-link {{ request()->routeIs('admin.quiz.*') ? 'active' : '' }}">
                <i class="bi bi-clipboard-check-fill"></i>
                <span>Data Quiz</span>
            </a>

            <a href="{{ route('admin.adopsi.index') }}"
               class="nav-link {{ request()->routeIs('admin.adopsi.*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text-fill"></i>
                <span>Pengajuan Adopsi</span>
            </a>

            <a href="{{ route('admin.history.index') }}"
               class="nav-link {{ request()->routeIs('admin.history.*') ? 'active' : '' }}">
                <i class="bi bi-clock-history"></i>
                <span>History Adopsi</span>
            </a>
        </div>

        <div class="sidebar-footer">
            <a href="{{ route('login') }}" class="btn-logout">
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
            <small>Admin Dashboard - Sistem Dokumentasi & Adopsi Hewan</small>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
