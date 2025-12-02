@extends('layoutadopter')

@section('content')

<style>
.kucing-card {
    transition: transform 0.3s ease;
    border: none;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 3px 12px rgba(0,0,0,0.1);
}

.kucing-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 20px rgba(0,0,0,0.15);
}

.kucing-img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    background: linear-gradient(135deg, #f8e6cc, #ffe8c2);
}

.badge-available {
    background: linear-gradient(135deg, #2ecc71, #27ae60);
    color: white;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.badge-adopted {
    background: linear-gradient(135deg, #95a5a6, #7f8c8d);
    color: white;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.error-message {
    color: #e74c3c;
    font-size: 13px;
    margin-top: 5px;
    display: none;
}
</style>

<div class="container mt-4">

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(isset($kucingList))

        <h2 class="mb-4 text-center fw-bold">Pilih Kucing untuk Diadopsi</h2>

        @if($kucingList->isEmpty())
            <div class="text-center py-5">
                <img src="https://img.icons8.com/clouds/200/cat.png" alt="No cats">
                <h5 class="text-muted mt-3">Belum ada kucing yang tersedia untuk adopsi</h5>
            </div>
        @else
            <div class="row">
                @foreach($kucingList as $k)
                    <div class="col-md-4 mb-4">
                        <div class="card kucing-card shadow-sm">

                            @if($k->image)
                                <img src="{{ asset('storage/' . $k->image) }}"
                                     class="kucing-img"
                                     alt="{{ $k->name }}"
                                     onerror="this.src='https://via.placeholder.com/400x220/f8e6cc/4b2e14?text=Foto+Tidak+Tersedia'">
                            @else
                                <img src="https://via.placeholder.com/400x220/f8e6cc/4b2e14?text=Foto+Tidak+Tersedia"
                                     class="kucing-img"
                                     alt="No Image">
                            @endif

                            <div class="card-body text-center">
                                <h5 class="fw-bold">{{ $k->name }}</h5>
                                <p class="text-muted small mb-2">
                                    <i class="bi bi-award"></i> {{ $k->breed ?? '-' }} |
                                    <i class="bi bi-calendar3"></i> {{ $k->age }} tahun
                                </p>

                                @if($k->description)
                                    <p class="text-muted small">{{ Str::limit($k->description, 60) }}</p>
                                @endif

                                <div class="mt-3">
                                    @if($k->status === 'adopted')
                                        <span class="badge-adopted">✗ Sudah Diadopsi</span>
                                    @elseif($k->status === 'available')
                                        <button class="btn btn-primary w-100"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modal{{ $k->id }}">
                                            Adopsi Sekarang
                                        </button>
                                    @else
                                        <button class="btn btn-secondary w-100" disabled>
                                            Tidak Tersedia
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modal{{ $k->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-4">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold">Konfirmasi Adopsi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body text-center">
                                    @if($k->image)
                                        <img src="{{ asset('storage/' . $k->image) }}"
                                             class="img-fluid rounded mb-3"
                                             style="max-height: 200px; object-fit: cover;"
                                             alt="{{ $k->name }}"
                                             onerror="this.style.display='none'">
                                    @endif
                                    <p class="fs-5">
                                        Apakah Anda yakin ingin mengadopsi
                                        <b class="text-primary">{{ $k->name }}</b>?
                                    </p>
                                    <p class="text-muted small">
                                        Anda akan mengikuti tes kelayakan adopsi terlebih dahulu.
                                    </p>
                                </div>

                                <div class="modal-footer justify-content-center">
                                    <button class="btn btn-secondary px-4" data-bs-dismiss="modal">
                                        Batal
                                    </button>
                                    @if($k->status === 'available')
                                        <a href="{{ route('adopter.quiz', $k->id) }}"
                                           class="btn btn-success px-4">
                                            Mulai Tes
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    @endif

    @if(isset($kucing) && isset($soal))

        <h2 class="mb-4 fw-bold text-center">
            Tes Kelayakan Adopsi untuk <span class="text-primary">{{ $kucing->name }}</span>
        </h2>

        <div class="alert alert-info">
            <strong>ℹ️ Perhatian:</strong>
            <ul class="mb-0">
                <li>Untuk soal isian, <strong>tidak boleh menggunakan simbol khusus</strong> (@#$%^&* dll)</li>
                <li>Hanya boleh menggunakan: <strong>huruf, angka, spasi, koma (,), titik (.), dan tanda hubung (-)</strong></li>
                <li>Minimal 10 karakter untuk jawaban isian</li>
            </ul>
        </div>

        <form method="POST" action="{{ route('adopter.quiz.submit', $kucing->id) }}" id="quizForm">
            @csrf

            @foreach($soal as $index => $s)
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">
                            Soal {{ $index + 1 }}: {{ $s->pertanyaan }}
                        </h5>

                        @if($s->tipe === 'isian')
                            <textarea class="form-control jawaban-isian"
                                    name="jawaban_{{ $s->id }}"
                                    id="jawaban_{{ $s->id }}"
                                    rows="3"
                                    placeholder="Tulis jawaban Anda di sini (minimal 10 karakter, tanpa simbol khusus)"
                                    required
                                    minlength="10"
                                    data-soal-id="{{ $s->id }}">{{ old('jawaban_' . $s->id) }}</textarea>
                            <div class="error-message" id="error_{{ $s->id }}">
                                ⚠️ Jawaban tidak boleh mengandung simbol khusus (@#$%^&* dll)
                            </div>
                            <small class="text-muted">
                                <span id="char_count_{{ $s->id }}">0</span> karakter (minimal 10)
                            </small>

                        @elseif($s->tipe === 'pg')
                            @foreach(['a','b','c','d'] as $opsi)
                                @if($s->{'opsi_'.$opsi})
                                    <div class="form-check mt-2">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="jawaban_{{ $s->id }}"
                                               value="{{ strtoupper($opsi) }}"
                                               id="soal{{ $s->id }}_{{ $opsi }}"
                                               {{ old('jawaban_' . $s->id) == strtoupper($opsi) ? 'checked' : '' }}
                                               required>

                                        <label class="form-check-label" for="soal{{ $s->id }}_{{ $opsi }}">
                                            {{ strtoupper($opsi) }}. {{ $s->{'opsi_'.$opsi} }}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        @endif

                    </div>
                </div>
            @endforeach

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success px-5 py-2 fs-5">
                    Kirim Jawaban
                </button>
            </div>

        </form>

    @endif

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const isianInputs = document.querySelectorAll('.jawaban-isian');

    isianInputs.forEach(input => {
        const soalId = input.dataset.soalId;
        const errorDiv = document.getElementById('error_' + soalId);
        const charCount = document.getElementById('char_count_' + soalId);

        input.addEventListener('input', function() {
            const length = this.value.length;
            charCount.textContent = length;

            const regex = /^[a-zA-Z0-9\s,.\-]*$/;

            if (!regex.test(this.value)) {
                errorDiv.style.display = 'block';
                this.style.borderColor = '#e74c3c';
            } else {
                errorDiv.style.display = 'none';
                this.style.borderColor = length >= 10 ? '#27ae60' : '#ced4da';
            }
        });

        input.addEventListener('keypress', function(e) {
            const char = String.fromCharCode(e.which);
            const regex = /^[a-zA-Z0-9\s,.\-]$/;

            if (!regex.test(char)) {
                e.preventDefault();
                errorDiv.style.display = 'block';
                setTimeout(() => {
                    if (regex.test(input.value)) {
                        errorDiv.style.display = 'none';
                    }
                }, 2000);
            }
        });
        input.dispatchEvent(new Event('input'));
    });

    const form = document.getElementById('quizForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            let hasError = false;
            const regex = /^[a-zA-Z0-9\s,.\-]+$/;

            isianInputs.forEach(input => {
                const value = input.value.trim();

                if (value.length < 10) {
                    alert('Jawaban isian minimal 10 karakter!');
                    hasError = true;
                    input.focus();
                    return false;
                }

                if (!regex.test(value)) {
                    alert('Jawaban tidak boleh mengandung simbol khusus (@#$%^&* dll)');
                    hasError = true;
                    input.focus();
                    return false;
                }
            });

            if (hasError) {
                e.preventDefault();
            }
        });
    }
});
</script>

@endsection
