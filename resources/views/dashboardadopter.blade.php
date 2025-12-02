@extends('layoutadopter')

@section('title', 'Dashboard Adopter')

@section('content')
<style>
.welcome-banner {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 40px;
    border-radius: 16px;
    margin-bottom: 30px;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.welcome-banner h2 {
    font-size: 32px;
    font-weight: bold;
    margin-bottom: 10px;
}

.feature-card {
    background: white;
    border-radius: 16px;
    padding: 25px;
    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    transition: transform 0.3s ease;
    border-left: 5px solid #c48a55;
}

.feature-card:hover {
    transform: translateY(-5px);
}

.feature-icon {
    font-size: 48px;
    margin-bottom: 15px;
}

.feature-title {
    font-size: 20px;
    font-weight: bold;
    color: #4b2e14;
    margin-bottom: 10px;
}

.feature-desc {
    color: #6b5030;
    margin-bottom: 15px;
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

.status-summary {
    background: linear-gradient(135deg, #f8e6cc, #ffe8c2);
    padding: 25px;
    border-radius: 16px;
    margin-bottom: 30px;
}

.status-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px;
    background: white;
    border-radius: 12px;
    margin-bottom: 15px;
}

.status-number {
    font-size: 32px;
    font-weight: bold;
    color: #4b2e14;
}

.status-label {
    font-size: 14px;
    color: #6b5030;
}

.info-box {
    background: white;
    padding: 20px;
    border-radius: 12px;
    border: 2px dashed #c48a55;
    text-align: center;
    color: #4b2e14;
}

/* Kucing Card Styles */
.kucing-mini-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
    height: 100%;
}

.kucing-mini-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.15);
}

.kucing-mini-img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    background: linear-gradient(135deg, #f8e6cc, #ffe8c2);
}

.kucing-mini-body {
    padding: 15px;
}

.kucing-mini-name {
    font-size: 16px;
    font-weight: bold;
    color: #4b2e14;
    margin-bottom: 8px;
}

.kucing-mini-info {
    font-size: 13px;
    color: #6b5030;
    margin-bottom: 5px;
}

.badge-mini-available {
    background: linear-gradient(135deg, #2ecc71, #27ae60);
    color: white;
    padding: 4px 10px;
    border-radius: 15px;
    font-size: 11px;
    font-weight: 600;
}

.section-cats {
    background: white;
    padding: 25px;
    border-radius: 16px;
    box-shadow: 0 3px 12px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

.section-cats h4 {
    color: #4b2e14;
    font-weight: bold;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 3px solid #c48a55;
}
</style>

<div class="welcome-banner">
    <h2>Selamat Datang, {{ auth()->user()->name }}!</h2>
    <p style="font-size: 16px; opacity: 0.9;">
        Temukan kucing yang sempurna untuk keluarga Anda di PawPac
    </p>
</div>

<div class="status-summary">
    <h4 class="fw-bold mb-4" style="color: #4b2e14;">Status Pengajuan Anda</h4>
    <div class="row">
        @php
            $myAdoptions = \App\Models\Adoption::where('adopter_id', auth()->id())->get();
            $pending = $myAdoptions->where('status', 'pending')->count();
            $approved = $myAdoptions->where('status', 'lulus')->count();
            $total = $myAdoptions->count();
        @endphp

        <div class="col-md-4">
            <div class="status-item">
                <div class="status-number">{{ $total }}</div>
                <div>
                    <div class="status-label">Total Pengajuan</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="status-item">
                <div class="status-number" style="color: #f39c12;">{{ $pending }}</div>
                <div>
                    <div class="status-label">Menunggu Review</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="status-item">
                <div class="status-number" style="color: #27ae60;">{{ $approved }}</div>
                <div>
                    <div class="status-label">Diterima</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section-cats">
    <h4>Kucing Tersedia untuk Adopsi</h4>

    @php
        $availableCats = \App\Models\Kucing::where('status', 'available')->take(3)->get();
    @endphp

    @if($availableCats->isEmpty())
        <div class="text-center py-4">
            <p class="text-muted">Belum ada kucing yang tersedia saat ini</p>
        </div>
    @else
        <div class="row">
            @foreach($availableCats as $cat)
                <div class="col-md-4">
                    <div class="kucing-mini-card">
                        @if($cat->image)
                            <img src="{{ asset('storage/' . $cat->image) }}"
                                 class="kucing-mini-img"
                                 alt="{{ $cat->name }}"
                                 onerror="this.src='https://via.placeholder.com/300x180/f8e6cc/4b2e14?text={{ urlencode($cat->name) }}'">
                        @else
                            <img src="https://via.placeholder.com/300x180/f8e6cc/4b2e14?text={{ urlencode($cat->name) }}"
                                 class="kucing-mini-img"
                                 alt="No Image">
                        @endif

                        <div class="kucing-mini-body">
                            <h6 class="kucing-mini-name">{{ $cat->name }}</h6>
                            <div class="kucing-mini-info">
                                <i class="bi bi-award"></i> {{ $cat->breed ?? '-' }}
                            </div>
                            <div class="kucing-mini-info">
                                <i class="bi bi-calendar3"></i> {{ $cat->age }} tahun
                            </div>
                            <div class="mt-3 d-flex justify-content-between align-items-center">
                                <span class="badge-mini-available">✓ Available</span>
                                <a href="{{ route('adopter.pilih') }}" class="btn btn-sm btn-primary">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-3">
            <a href="{{ route('adopter.pilih') }}" class="btn-feature">
                Lihat Semua Kucing →
            </a>
        </div>
    @endif
</div>

<div class="row">
    <div class="col-md-4">
        <div class="feature-card">
            <div class="feature-title">Tes Adopsi</div>
            <div class="feature-desc">
                Ikuti tes kelayakan adopsi untuk menemukan kucing yang cocok dengan Anda
            </div>
            <a href="{{ route('adopter.pilih') }}" class="btn-feature">
                Mulai Tes →
            </a>
        </div>
    </div>

    <div class="col-md-4">
        <div class="feature-card">
            <div class="feature-title">Materi Edukasi</div>
            <div class="feature-desc">
                Pelajari cara merawat kucing dengan baik melalui materi edukatif kami
            </div>
            <a href="{{ route('adopter.materi') }}" class="btn-feature">
                Baca Materi →
            </a>
        </div>
    </div>

    <div class="col-md-4">
        <div class="feature-card">
            <div class="feature-title">History Tes</div>
            <div class="feature-desc">
                Lihat riwayat dan status pengajuan adopsi yang telah Anda ajukan
            </div>
            <a href="{{ route('adopter.status') }}" class="btn-feature">
                Lihat History →
            </a>
        </div>
    </div>
</div>

<div class="info-box mt-4">
    <h5 style="font-weight: bold; margin-bottom: 15px;">Tips Adopsi</h5>
    <p style="margin-bottom: 10px;">
        Pastikan Anda sudah membaca materi perawatan kucing sebelum mengikuti tes adopsi.
        <br>
        Ini akan membantu Anda memahami tanggung jawab sebagai pemilik kucing.
    </p>
</div>

@if($myAdoptions->where('status', 'pending')->count() > 0)
    <div class="alert alert-info mt-4">
        <strong>ℹ️ Info:</strong> Anda memiliki {{ $pending }} pengajuan yang sedang menunggu review dari provider.
    </div>
@endif

@if($myAdoptions->where('status', 'lulus')->count() > 0)
    <div class="alert alert-success mt-4">
        <strong>🎉 Selamat!</strong> Anda telah berhasil mengadopsi {{ $approved }} kucing. Terima kasih telah memberikan rumah yang penuh kasih!
    </div>
@endif
@endsection
