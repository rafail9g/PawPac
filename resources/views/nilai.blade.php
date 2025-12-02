@extends('layoutprovider')

@section('content')

<style>
.card-adopsi {
    background: #ffffff;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    transition: transform 0.2s;
}

.card-adopsi:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
}

.badge-status {
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 13px;
}

.badge-pending {
    background-color: #fff3cd;
    color: #856404;
}

.badge-lulus {
    background-color: #d4edda;
    color: #155724;
}

.badge-tidak-lulus {
    background-color: #f8d7da;
    color: #721c24;
}

.btn-review {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border: none;
    padding: 8px 20px;
    border-radius: 8px;
    font-weight: 600;
    transition: 0.3s;
}

.btn-review:hover {
    background: linear-gradient(135deg, #764ba2, #667eea);
    transform: scale(1.05);
}

.soal-card {
    background: #f8f9fa;
    border-left: 4px solid #c48a55;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
}

.jawaban-user {
    background: #e3f2fd;
    padding: 15px;
    border-radius: 8px;
    margin: 10px 0;
    border-left: 3px solid #2196f3;
}

.section-title {
    font-size: 24px;
    font-weight: bold;
    color: #4b2e14;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 3px solid #c48a55;
}

.info-box {
    background: linear-gradient(135deg, #f8e6cc, #ffe8c2);
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 20px;
}

.info-item {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.info-label {
    font-weight: 600;
    color: #4b2e14;
    width: 120px;
}

.info-value {
    color: #6b5030;
}

.btn-submit-nilai {
    background: linear-gradient(135deg, #2ecc71, #27ae60);
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 16px;
    transition: 0.3s;
}

.btn-submit-nilai:hover {
    background: linear-gradient(135deg, #27ae60, #1e8449);
    transform: scale(1.05);
}

.select-nilai {
    width: 200px;
    padding: 8px;
    border-radius: 8px;
    border: 2px solid #c48a55;
}

.badge-type {
    display: inline-block;
    padding: 5px 12px;
    border-radius: 15px;
    font-size: 12px;
    font-weight: 600;
}

.badge-pg {
    background-color: #d1ecf1;
    color: #0c5460;
}

.badge-isian {
    background-color: #fff3cd;
    color: #856404;
}

.nama {
    font-size: 20px;
    font-weight: bold;
    color: #4b2e14;
    margin-bottom: 8px;
}

.btn-feature {
    text-align: center;
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

<div class="container mt-4">

    @if(isset($pengajuan))

        <h2 class="section-title">Daftar Pengajuan Adopsi</h2>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($pengajuan->isEmpty())
            <div class="text-center py-5">
                <img src="https://img.icons8.com/clouds/200/empty-box.png" alt="Empty">
                <h5 class="text-muted mt-3">Belum ada pengajuan adopsi</h5>
            </div>
        @else
            <div class="row">
                @foreach ($pengajuan as $p)
                    <div class="col-md-6 col-lg-4">
                        <div class="card-adopsi">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h5 class="fw-bold nama mb-0">{{ $p->kucing->name }}</h5>
                                <span class="badge-status
                                    @if($p->status == 'pending') badge-pending
                                    @elseif($p->status == 'lulus') badge-lulus
                                    @else badge-tidak-lulus
                                    @endif">
                                    {{ ucfirst($p->status) }}
                                </span>
                            </div>

                            <div class="mb-3">
                                <small class="text-muted">Adopter:</small>
                                <p class="mb-1 fw-semibold">👤 {{ $p->adopter->name }}</p>
                            </div>

                            <div class="mb-3">
                                <small class="text-muted">Tanggal Pengajuan:</small>
                                <p class="mb-0">{{ $p->created_at->format('d M Y, H:i') }}</p>
                            </div>

                            @if($p->status == 'pending')
                                <a href="{{ route('provider.adoption.review', $p->id) }}"
                                   class="btn-feature w-100">
                                    Review Sekarang
                                </a>
                            @else
                                <button class="btn btn-secondary w-100" disabled>
                                    Sudah Dinilai
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    @endif


    @if(isset($adopsi))

        <h2 class="section-title">Review Pengajuan Adopsi</h2>

        <div class="info-box">
            <div class="info-item">
                <span class="info-label">Kucing:</span>
                <span class="info-value">{{ $adopsi->kucing->name }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">👤 Adopter:</span>
                <span class="info-value">{{ $adopsi->adopter->name }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Email:</span>
                <span class="info-value">{{ $adopsi->adopter->email }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Tanggal:</span>
                <span class="info-value">{{ $adopsi->created_at->format('d M Y, H:i') }}</span>
            </div>
        </div>

        <form method="POST" action="{{ route('provider.nilai', $adopsi->id) }}">
            @csrf

            <h4 class="fw-bold mb-3 mt-4" style="color: #4b2e14;">Jawaban Quiz</h4>

            @foreach($adopsi->jawaban as $index => $j)
                <div class="soal-card">

                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h6 class="fw-bold mb-0" style="color: #4b2e14;">
                            Soal {{ $index + 1 }}
                        </h6>
                        <span class="badge-type {{ $j->soal->tipe == 'pg' ? 'badge-pg' : 'badge-isian' }}">
                            {{ $j->soal->tipe == 'pg' ? '✓ Pilihan Ganda' : 'Isian' }}
                        </span>
                    </div>

                    <p class="mb-3" style="font-size: 15px; line-height: 1.6;">
                        {{ $j->soal->pertanyaan }}
                    </p>

                    <div class="jawaban-user">
                        <small class="text-muted d-block mb-1">Jawaban User:</small>
                        <strong style="color: #0d6efd;">{{ $j->jawaban }}</strong>
                    </div>

                    @if($j->soal->tipe == 'pg')
                        <div class="mt-3">
                            @if($j->is_correct)
                                <span class="badge bg-success">Jawaban Benar (Otomatis)</span>
                            @else
                                <span class="badge bg-danger">Jawaban Salah (Otomatis)</span>
                            @endif
                        </div>
                    @else
                        <div class="mt-3">
                            <label class="fw-semibold mb-2" style="color: #4b2e14;">
                                Penilaian Provider:
                            </label>
                            <select name="nilai_{{ $j->id }}" class="form-select select-nilai" required>
                                <option value="">-- Pilih --</option>
                                <option value="1">Benar</option>
                                <option value="0">Salah</option>
                            </select>
                        </div>
                    @endif

                </div>
            @endforeach

            <div class="card-adopsi mt-4">
                <h5 class="fw-bold mb-3" style="color: #4b2e14;">Keputusan Akhir</h5>
                <select name="status" class="form-select" required style="border: 2px solid #c48a55;">
                    <option value="">-- Pilih Status --</option>
                    <option value="lulus">✓ Diterima (Lulus)</option>
                    <option value="tidak_lulus">✗ Tidak Lulus</option>
                </select>

                <button type="submit" class="btn btn-submit-nilai w-100 mt-4">
                    Simpan Penilaian
                </button>
            </div>

        </form>

    @endif

</div>

@endsection
