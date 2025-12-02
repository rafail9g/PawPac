@extends('layoutadopter')

@section('content')

<style>
.materi-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 40px;
    border-radius: 16px;
    margin-bottom: 30px;
    text-align: center;
}

.materi-card {
    background: white;
    border-radius: 16px;
    padding: 25px;
    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    transition: transform 0.3s ease;
    border-left: 5px solid #c48a55;
}

.materi-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
}

.materi-kategori {
    display: inline-block;
    padding: 6px 14px;
    background: linear-gradient(135deg, #f8e6cc, #ffe8c2);
    color: #4b2e14;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 15px;
}

.materi-judul {
    font-size: 22px;
    font-weight: bold;
    color: #4b2e14;
    margin-bottom: 15px;
}

.materi-isi {
    color: #6b5030;
    line-height: 1.8;
    font-size: 15px;
}

.empty-state {
    text-align: center;
    padding: 80px 20px;
}

.search-box {
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 25px;
}

.filter-badges {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-top: 15px;
}

.filter-badge {
    padding: 8px 16px;
    background: #f8f9fa;
    border: 2px solid #c48a55;
    border-radius: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 600;
    color: #4b2e14;
}

.filter-badge:hover, .filter-badge.active {
    background: linear-gradient(135deg, #c48a55, #a16c3e);
    color: white;
}

.materi-icon {
    font-size: 32px;
    margin-bottom: 10px;
}
</style>

<div class="container mt-4">

    <div class="materi-header">
        <h2 style="font-size: 36px; font-weight: bold; margin-bottom: 10px;">
            Materi Edukasi Perawatan Kucing
        </h2>
        <p style="font-size: 16px; opacity: 0.9;">
            Pelajari cara merawat kucing dengan baik sebelum mengadopsi
        </p>
    </div>

    <div class="search-box">
        <div class="row align-items-center">
            <div class="col-md-8">
                <input type="text"
                       id="searchInput"
                       class="form-control"
                       placeholder="Cari materi berdasarkan judul atau kategori...">
            </div>
            <div class="col-md-4">
                <select id="filterKategori" class="form-select">
                    <option value="">Semua Kategori</option>
                    @php
                        $kategoris = \App\Models\Materi::pluck('kategori')->unique()->filter();
                    @endphp
                    @foreach($kategoris as $kat)
                        <option value="{{ $kat }}">{{ $kat }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    @if($materi->isEmpty())
        <div class="empty-state">
            <img src="https://img.icons8.com/clouds/200/book.png" alt="No Content">
            <h5 class="text-muted mt-3">Belum ada materi edukasi</h5>
            <p class="text-muted">Materi akan segera ditambahkan</p>
        </div>
    @else
        <div class="row" id="materiContainer">
            @foreach ($materi as $m)
                <div class="col-md-6 materi-item"
                     data-judul="{{ strtolower($m->judul) }}"
                     data-kategori="{{ strtolower($m->kategori ?? '') }}">
                    <div class="materi-card">

                        @if($m->kategori)
                            <span class="materi-kategori">
                                {{ $m->kategori }}
                            </span>
                        @endif

                        <h5 class="materi-judul">{{ $m->judul }}</h5>

                        <div class="materi-isi">
                            {{ $m->isi }}
                        </div>

                        <div class="mt-3 text-muted" style="font-size: 13px;">
                            <i class="bi bi-calendar3"></i>
                            Ditambahkan: {{ $m->created_at->format('d M Y') }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>

<script>
document.getElementById('searchInput').addEventListener('keyup', filterMateri);
document.getElementById('filterKategori').addEventListener('change', filterMateri);

function filterMateri() {
    const searchValue = document.getElementById('searchInput').value.toLowerCase();
    const kategoriValue = document.getElementById('filterKategori').value.toLowerCase();
    const items = document.querySelectorAll('.materi-item');

    items.forEach(item => {
        const judul = item.dataset.judul;
        const kategori = item.dataset.kategori;

        const matchSearch = judul.includes(searchValue) || kategori.includes(searchValue);
        const matchKategori = kategoriValue === '' || kategori.includes(kategoriValue);

        item.style.display = (matchSearch && matchKategori) ? 'block' : 'none';
    });
}
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

@endsection
