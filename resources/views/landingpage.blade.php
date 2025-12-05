<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PawPac – Dokumentasi Hewan Adopsi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #fffaf2;
            font-family: 'Poppins', sans-serif;
            color: #4b2e14;
            overflow-x: hidden;
        }

        .navbar-custom {
            background: linear-gradient(135deg, #f8e6cc, #ffe8c2);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 16px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
        }

        .navbar-brand {
            font-size: 32px;
            font-weight: 700;
            color: #c48a55 !important;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand-logo {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #c48a55, #a16c3e);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
        }

        .brand-logo svg {
            width: 28px;
            height: 28px;
            fill: white;
        }

        .nav-link {
            color: #4b2e14 !important;
            font-weight: 500;
            padding: 10px 20px !important;
            border-radius: 10px;
            transition: all 0.3s ease;
            margin: 0 5px;
        }

        .nav-link:hover {
            background-color: rgba(196, 138, 85, 0.2);
            color: #c48a55 !important;
            transform: translateY(-2px);
        }

        .btn-highlight {
            background: linear-gradient(135deg, #c48a55, #a16c3e);
            color: white !important;
            border-radius: 10px;
            padding: 10px 25px;
            transition: all 0.3s ease;
            border: none;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(196, 138, 85, 0.3);
        }

        .btn-highlight:hover {
            background: linear-gradient(135deg, #a16c3e, #8b5e34);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(196, 138, 85, 0.4);
        }

        .hero {
            background: linear-gradient(135deg, rgba(196, 138, 85, 0.9), rgba(161, 108, 62, 0.9)),
                        url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><rect fill="%23f8e6cc" width="1200" height="600"/><circle fill="%23ffe8c2" opacity="0.3" cx="200" cy="100" r="150"/><circle fill="%23c48a55" opacity="0.2" cx="900" cy="400" r="200"/></svg>');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding: 120px 20px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 50%, rgba(255, 255, 255, 0.1), transparent);
        }

        .hero-content {
            position: relative;
            z-index: 1;
            animation: fadeInUp 1s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero h1 {
            font-size: 56px;
            font-weight: bold;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero p {
            font-size: 22px;
            margin-top: 15px;
            font-style: italic;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
        }

        .section-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-header h3 {
            font-size: 38px;
            font-weight: bold;
            color: #4b2e14;
            margin-bottom: 10px;
        }

        .section-header p {
            color: #8b6f4e;
            font-size: 16px;
        }

        .section-divider {
            width: 80px;
            height: 4px;
            background: linear-gradient(135deg, #c48a55, #a16c3e);
            margin: 20px auto;
            border-radius: 2px;
        }

        .gallery-section {
            padding: 80px 0;
            background: linear-gradient(180deg, #fffaf2 0%, #fff8ed 100%);
        }

        .pet-card {
            overflow: hidden;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            background: white;
        }

        .pet-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        .pet-card img {
            height: 280px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .pet-card:hover img {
            transform: scale(1.1);
        }

        .features-section {
            padding: 80px 0;
            background: white;
        }

        .feature-box {
            text-align: center;
            padding: 30px;
            border-radius: 16px;
            background: linear-gradient(135deg, #f8e6cc, #ffe8c2);
            transition: all 0.3s ease;
            height: 100%;
        }

        .feature-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            font-size: 48px;
            margin-bottom: 20px;
            color: #c48a55;
        }

        .feature-box h5 {
            font-weight: bold;
            color: #4b2e14;
            margin-bottom: 15px;
        }

        .feature-box p {
            color: #6b5030;
            margin: 0;
        }

        .cta-section {
            padding: 80px 0;
            background: linear-gradient(135deg, #c48a55 0%, #a16c3e 100%);
            color: white;
            text-align: center;
        }

        .cta-section h3 {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .cta-section p {
            font-size: 18px;
            margin-bottom: 30px;
        }

        .btn-cta {
            background: white;
            color: #c48a55;
            padding: 15px 40px;
            border-radius: 10px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .btn-cta:hover {
            background: #f8e6cc;
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.3);
        }

        footer {
            background: linear-gradient(135deg, #4b2e14, #6b5030);
            color: white;
            padding: 40px 0 20px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }

        .footer-section h5 {
            font-weight: bold;
            margin-bottom: 15px;
            color: #f8e6cc;
        }

        .footer-section p, .footer-section a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            display: block;
            margin-bottom: 8px;
        }

        .footer-section a:hover {
            color: #f8e6cc;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
            text-align: center;
            color: rgba(255, 255, 255, 0.7);
        }

        .social-links {
            display: flex;
            gap: 15px;
        }

        .social-link {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background: #c48a55;
            transform: translateY(-3px);
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 36px;
            }

            .hero p {
                font-size: 16px;
            }

            .section-header h3 {
                font-size: 28px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <div class="logo-container">
                <div class="brand-logo">
                    <img src="{{ asset('storage/images/kucing/Logo.png') }}" alt="Logo" style="width: 50px;">
                </div>
                <div class="brand-text">PawPac</div>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="/">
                            <i class="bi bi-house-door"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">
                            <i class="bi bi-box-arrow-in-right"></i> Masuk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-highlight ms-2" href="/register">
                            <i class="bi bi-person-plus"></i> Daftar
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-content">
            <h1>Selamat Datang di PawPac</h1>
            <p>Satu langkah kecil dari Anda, kehidupan baru untuk mereka</p>
        </div>
    </section>

    <section class="features-section">
        <div class="container">
            <div class="section-header">
                <h3>Mengapa Pilih PawPac?</h3>
                <div class="section-divider"></div>
                <p>Platform terpercaya untuk adopsi hewan dengan sistem yang terverifikasi</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="bi bi-patch-check"></i>
                        </div>
                        <h5>Hewan Terverifikasi</h5>
                        <p>Semua hewan telah melalui pemeriksaan kesehatan lengkap</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="bi bi-book"></i>
                        </div>
                        <h5>Edukasi Lengkap</h5>
                        <p>Materi perawatan dan panduan adopsi yang komprehensif</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h5>Proses Transparan</h5>
                        <p>Sistem adopsi yang jelas dan terstruktur dengan baik</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="gallery-section">
        <div class="container">
            <div class="section-header">
                <h3>Hewan yang Berhasil Diselamatkan</h3>
                <div class="section-divider"></div>
                <p>Kisah sukses penyelamatan dan adopsi dari komunitas kami</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="pet-card">
                        <img src="https://asset-a.grid.id/crop/0x0:0x0/700x0/photo/2020/04/23/3334572087.jpg" class="w-100" alt="Cat 1">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="pet-card">
                        <img src="https://asset-a.grid.id/crop/0x0:0x0/700x0/photo/2020/02/06/3218666674.jpg" class="w-100" alt="Cat 2">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="pet-card">
                        <img src="https://asset-a.grid.id/crop/0x0:0x0/700x0/photo/2021/12/07/7-5fc65f9349969__700jpg-20211207103057.jpg" class="w-100" alt="Cat 3">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="pet-card">
                        <img src="https://media.suara.com/pictures/970x544/2021/06/28/98187-kucing-dievakuasi-hingga-berubah-cantik.jpg" class="w-100" alt="Cat 4">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="pet-card">
                        <img src="https://i.pinimg.com/736x/c6/f3/dc/c6f3dc0b5097831b4a43956ab23d71e4.jpg" class="w-100" alt="Cat 5">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="pet-card">
                        <img src="https://cdn2.ettoday.net/images/7566/e7566784.jpg" class="w-100" alt="Cat 6">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="container">
            <h3>Siap Memberikan Rumah Baru?</h3>
            <p>Bergabunglah dengan komunitas pecinta hewan dan berikan kesempatan hidup baru</p>
            <a href="/register" class="btn btn-cta">
                <i class="bi bi-heart-fill"></i> Mulai Adopsi Sekarang
            </a>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h5>PawPac</h5>
                    <p>Platform terpercaya untuk dokumentasi dan adopsi hewan dengan sistem yang transparan dan terverifikasi.</p>
                    <div class="social-links">
                        <a href="#" class="social-link"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-link"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-link"><i class="bi bi-twitter"></i></a>
                    </div>
                </div>

                <div class="footer-section">
                    <h5>Menu Cepat</h5>
                    <a href="/">Beranda</a>
                    <a href="/login">Login</a>
                    <a href="/register">Registrasi</a>
                </div>

                <div class="footer-section">
                    <h5>Kontak</h5>
                    <p><i class="bi bi-envelope"></i> info@pawpac.com</p>
                    <p><i class="bi bi-telephone"></i> +62 812 3456 7890</p>
                    <p><i class="bi bi-geo-alt"></i> Surabaya, Indonesia</p>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2025 PawPac — Semua Hak Dilindungi</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
