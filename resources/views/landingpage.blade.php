<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PawPac – Dokumentasi Hewan Adopsi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #fffaf2;
            font-family: 'Poppins', sans-serif;
            color: #4b2e14;
        }

        .navbar-custom {
            background-color: #f8e6cc;
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
            padding: 12px 0;
        }

        .navbar-brand {
            font-size: 28px;
            font-weight: 700;
            color: #c48a55 !important;
        }

        .nav-link {
            color: #4b2e14 !important;
            font-weight: 500;
            padding: 8px 16px !important;
            border-radius: 8px;
            transition: 0.25s;
        }

        .nav-link:hover {
            background-color: #e5d2b8;
            color: #c48a55 !important;
        }

        .btn-highlight {
            background-color: #c48a55;
            color: white !important;
            border-radius: 8px;
            padding: 8px 20px;
            transition: 0.25s;
        }

        .btn-highlight:hover {
            background-color: #a16c3e;
        }

        .hero {
            background: url('https://i.imgur.com/zAa2ePX.png');
            background-size: cover;
            background-position: center;
            padding: 150px 20px;
            text-align: center;
            color: rgb(0, 0, 0);
        }

        .hero h1 {
            font-size: 50px;
            font-weight: bold;
        }

        .hero p {
            font-size: 18px;
            margin-top: 10px;
        }

        .pet-card img {
            height: 240px;
            object-fit: cover;
            border-radius: 10px;
        }

    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="/">PawPac</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="/">Beranda</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/login">Masuk</a>
                    </li>

                    <li class="nav-item">
                        <a class="btn btn-highlight ms-2" href="/register">Daftar</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <section class="hero">
        <h1>Selamat datang di PawPac</h1>
        <p>"Satu langkah kecil dari Anda, kehidupan baru untuk mereka."</p>
    </section>

    <div class="container py-5" id="dok">
        <h3 class="fw-bold mb-4 text-center">Hewan yang Berhasil Diselamatkan</h3>

        <div class="row g-4 justify-content-center">

            <div class="col-md-4 pet-card">
                <img src="https://asset-a.grid.id/crop/0x0:0x0/700x0/photo/2020/04/23/3334572087.jpg" class="w-100">
            </div>

            <div class="col-md-4 pet-card">
                <img src="https://asset-a.grid.id/crop/0x0:0x0/700x0/photo/2020/02/06/3218666674.jpg" class="w-100">
            </div>

            <div class="col-md-4 pet-card">
                <img src="https://asset-a.grid.id/crop/0x0:0x0/700x0/photo/2021/12/07/7-5fc65f9349969__700jpg-20211207103057.jpg" class="w-100">
            </div>

            <div class="col-md-4 pet-card">
                <img src="https://media.suara.com/pictures/970x544/2021/06/28/98187-kucing-dievakuasi-hingga-berubah-cantik.jpg" class="w-100">
            </div>

            <div class="col-md-4 pet-card">
                <img src="https://i.pinimg.com/736x/c6/f3/dc/c6f3dc0b5097831b4a43956ab23d71e4.jpg" class="w-100">
            </div>

            <div class="col-md-4 pet-card">
                <img src="https://cdn2.ettoday.net/images/7566/e7566784.jpg" class="w-100">
            </div>

        </div>
    </div>

    <footer class="text-center py-3 bg-light">
        <small>&copy; 2025 PawPac — Semua Hak Dilindungi.</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
