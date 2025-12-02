@extends('layoutprovider')

@section('title', 'Dashboard Provider')

@section('content')
<style>
.hero-section {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    color: white;
    padding: 40px;
    border-radius: 16px;
    margin-bottom: 30px;
    box-shadow: 0 4px 15px rgba(17, 153, 142, 0.3);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-box {
    background: white;
    padding: 25px;
    border-radius: 16px;
    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.1);
    text-align: center;
    transition: transform 0.3s ease;
}

.stat-box:hover {
    transform: translateY(-5px);
}

.stat-number {
    font-size: 42px;
    font-weight: bold;
    margin-bottom: 10px;
}

.stat-number.purple { color: #667eea; }
.stat-number.green { color: #27ae60; }
.stat-number.orange { color: #f39c12; }
.stat-number.red { color: #e74c3c; }

.stat-label {
    color: #6b5030;
    font-size: 14px;
    font-weight: 600;
}

.action-panel {
    background: white;
    border-radius: 16px;
    padding: 25px;
    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

.action-button {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 20px;
    background: linear-gradient(135deg, #f8e6cc, #ffe8c2);
    border-radius: 12px;
    margin-bottom: 15px;
    text-decoration: none;
    color: #4b2e14;
    transition: all 0.3s ease;
}

.action-button:hover {
    background: linear-gradient(135deg, #ffe8c2, #ffd699);
    transform: translateX(5px);
    color: #4b2e14;
}

.action-icon {
    font-size: 40px;
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: white;
    border-radius: 12px;
}

.action-content h5 {
    margin: 0 0 5px 0;
    font-weight: bold;
}

.action-content p {
    margin: 0;
    font-size: 14px;
    opacity: 0.8;
}

.pending-list {
    background: white;
    border-radius: 16px;
    padding: 25px;
    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.1);
}

.pending-item {
    padding: 15px;
    background: #fff3cd;
    border-left: 4px solid #f39c12;
    border-radius: 8px;
    margin-bottom: 15px;
}

.section-title {
    font-size: 24px;
    font-weight: bold;
    color: #4b2e14;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 3px solid #c48a55;
}
</style>

<div class="hero-section">
    <h2 style="font-size: 32px; font-weight: bold; margin-bottom: 10px;">
        Selamat Datang, {{ auth()->user()->name }}!
    </h2>
    <p style="font-size: 16px; opacity: 0.9;">
        Kelola kucing dan review pengajuan adopsi dengan mudah
    </p>
</div>

<div class="stats-grid">
    @php
        $totalKucing = \App\Models\Kucing::where('provider_id', 1)->count();
        $available = \App\Models\Kucing::where('provider_id', 1)->where('status', 'available')->count();
        $adopted = \App\Models\Kucing::where('provider_id', 1)->where('status', 'adopted')->count();
        $pendingReview = \App\Models\Adoption::where('status', 'pending')->count();
    @endphp

    <div class="stat-box">
        <div class="stat-number purple">{{ $totalKucing }}</div>
        <div class="stat-label">Total Kucing</div>
    </div>

    <div class="stat-box">
        <div class="stat-number green">{{ $available }}</div>
        <div class="stat-label">Tersedia</div>
    </div>

    <div class="stat-box">
        <div class="stat-number orange">{{ $adopted }}</div>
        <div class="stat-label">Sudah Diadopsi</div>
    </div>

    <div class="stat-box">
        <div class="stat-number red">{{ $pendingReview }}</div>
        <div class="stat-label">Menunggu Review</div>
    </div>
</div>

<div class="row">
    <div class="col-md-7">
        <div class="action-panel">
            <h4 class="section-title">Menu Utama</h4>

            <a href="{{ route('provider.kucing.index') }}" class="action-button">
                <div class="action-content">
                    <h5>Kelola Data Kucing</h5>
                    <p>Tambah, edit, atau hapus data kucing yang tersedia untuk adopsi</p>
                </div>
            </a>

            <a href="{{ route('provider.adoption.list') }}" class="action-button">
                <div class="action-content">
                    <h5>Nilai Jawaban Tes</h5>
                    <p>Review dan nilai jawaban tes dari calon adopter</p>
                </div>
            </a>
        </div>

        <div class="alert alert-info">
            <strong>Tips:</strong> Pastikan untuk mereview pengajuan adopsi secara berkala agar calon adopter tidak menunggu terlalu lama.
        </div>
    </div>

    <div class="col-md-5">
        <div class="pending-list">
            <h4 class="section-title">Pengajuan Menunggu</h4>

            @php
                $pendingAdoptions = \App\Models\Adoption::with(['adopter', 'kucing'])
                    ->where('status', 'pending')
                    ->latest()
                    ->take(5)
                    ->get();
            @endphp

            @forelse($pendingAdoptions as $adoption)
                <div class="pending-item">
                    <div style="font-weight: 600; color: #4b2e14; margin-bottom: 5px;">
                        {{ $adoption->adopter->name }}
                    </div>
                    <small style="color: #6b5030;">
                        Mengajukan adopsi untuk <strong>{{ $adoption->kucing->name }}</strong>
                        <br>
                        <span style="opacity: 0.7;">{{ $adoption->created_at->diffForHumans() }}</span>
                    </small>
                    <div class="mt-2">
                        <a href="{{ route('provider.adoption.review', $adoption->id) }}"
                           class="btn btn-sm btn-warning">
                            Review Sekarang
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted py-4">
                    <p>Tidak ada pengajuan yang menunggu</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

@if($pendingReview > 0)
    <div class="alert alert-warning mt-4">
        <strong>⚠️ Perhatian:</strong> Ada {{ $pendingReview }} pengajuan adopsi yang menunggu review Anda.
    </div>
@endif

@endsection
