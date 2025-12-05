@extends('layoutadmin')

@section('title', 'Dashboard Admin')

@section('content')
<style>
.stats-card {
    background: linear-gradient(135deg, #F7C46C, #DFA45A);
    border-radius: 16px;
    padding: 25px;
    color: white;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    transition: transform 0.3s ease;
    margin-bottom: 20px;
}

.stats-card:hover {
    transform: translateY(-5px);
}

.stats-card.green {
    background: linear-gradient(135deg, #F7C46C);
}

.stats-card.orange {
    background: linear-gradient(135deg, #F7C46C, #DFA45A);
}

.stats-card.blue {
    background: linear-gradient(135deg, #F7C46C, #F8E3C5);
}

.stats-number {
    font-size: 48px;
    font-weight: bold;
    margin-bottom: 10px;
}

.stats-label {
    font-size: 16px;
    opacity: 0.9;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.quick-actions {
    background: white;
    border-radius: 16px;
    padding: 25px;
    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.1);
}

.action-btn {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px 20px;
    background: linear-gradient(135deg, #f8e6cc, #ffe8c2);
    border-radius: 12px;
    border: none;
    color: #4b2e14;
    font-weight: 600;
    transition: all 0.3s ease;
    margin-bottom: 15px;
    width: 100%;
    text-align: left;
}

.action-btn:hover {
    transform: translateX(5px);
    background: linear-gradient(135deg, #ffe8c2, #ffd699);
}

.action-btn i {
    font-size: 24px;
    color: #c48a55;
}

.section-title {
    font-size: 24px;
    font-weight: bold;
    color: #4b2e14;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 3px solid #c48a55;
}

.recent-activity {
    background: white;
    border-radius: 16px;
    padding: 25px;
    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
}

.activity-item {
    padding: 15px;
    border-left: 4px solid #c48a55;
    background: #f8f9fa;
    border-radius: 8px;
    margin-bottom: 15px;
}

.welcome-header {
    background: linear-gradient(135deg, #f8e6cc, #ffe8c2);
    padding: 30px;
    border-radius: 16px;
    margin-bottom: 30px;
    text-align: center;
}

.welcome-header h2 {
    color: #4b2e14;
    font-size: 32px;
    font-weight: bold;
    margin-bottom: 10px;
}

.welcome-header p {
    color: #6b5030;
    font-size: 16px;
}
</style>

<div class="welcome-header">
    <h2>Selamat Datang, {{ auth()->user()->name }}!</h2>
    <p>Kelola sistem PawPac</p>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-number">{{ \App\Models\Pengguna::where('role', 'adopter')->count() }}</div>
            <div class="stats-label">Total Adopter</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-number">{{ \App\Models\Adoption::where('status', 'lulus')->count() }}</div>
            <div class="stats-label">Adopsi Berhasil</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-number">{{ \App\Models\Adoption::where('status', 'pending')->count() }}</div>
            <div class="stats-label">Menunggu Review</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-number">{{ \App\Models\Materi::count() }}</div>
            <div class="stats-label">Total Materi</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="quick-actions">
            <h4 class="section-title">Halaman</h4>

            <a href="{{ route('admin.adopter.index') }}" class="action-btn text-decoration-none">
                <i class="bi bi-people-fill"></i>
                <div>
                    <div style="font-size: 16px;">Kelola Data Adopter</div>
                    <small style="opacity: 0.7;">Lihat dan kelola semua adopter</small>
                </div>
            </a>

            <a href="{{ route('admin.adopsi.index') }}" class="action-btn text-decoration-none">
                <i class="bi bi-clipboard-check"></i>
                <div>
                    <div style="font-size: 16px;">Kelola Pengajuan Adopsi</div>
                    <small style="opacity: 0.7;">Proses pengajuan yang masuk</small>
                </div>
            </a>

            <a href="{{ route('admin.materi.index') }}" class="action-btn text-decoration-none">
                <i class="bi bi-book"></i>
                <div>
                    <div style="font-size: 16px;">Kelola Materi Edukasi</div>
                    <small style="opacity: 0.7;">Tambah atau edit materi perawatan</small>
                </div>
            </a>

            <a href="{{ route('admin.history.index') }}" class="action-btn text-decoration-none">
                <i class="bi bi-clock-history"></i>
                <div>
                    <div style="font-size: 16px;">Kelola History Adopsi</div>
                    <small style="opacity: 0.7;">Riwayat semua adopsi</small>
                </div>
            </a>
        </div>
    </div>

    <div class="col-md-6">
        <div class="recent-activity">
            <h4 class="section-title">Aktivitas Terbaru</h4>

            @php
                $recentAdoptions = \App\Models\Adoption::with(['adopter', 'kucing'])
                    ->latest()
                    ->take(5)
                    ->get();
            @endphp

            @forelse($recentAdoptions as $adoption)
                <div class="activity-item">
                    <div style="font-weight: 600; color: #4b2e14;">
                        {{ $adoption->adopter->name }}
                    </div>
                    <small style="color: #6b5030;">
                        Mengajukan adopsi untuk <strong>{{ $adoption->kucing->name }}</strong>
                        <br>
                        <span style="opacity: 0.7;">{{ $adoption->created_at->diffForHumans() }}</span>
                    </small>
                    <div class="mt-2">
                        @if($adoption->status == 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif($adoption->status == 'lulus')
                            <span class="badge bg-success">Diterima</span>
                        @else
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center text-muted py-4">
                    <p>Belum ada aktivitas</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection
