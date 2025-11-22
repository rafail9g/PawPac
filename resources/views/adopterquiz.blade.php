@extends('layoutadopter')

@section('content')

<div class="container mt-4">

    {{-- ====== MODE PILIH KUCING ====== --}}
    @if(isset($kucingList))

        <h2 class="mb-4 text-center fw-bold">Pilih Kucing untuk Diadopsi</h2>

        <div class="row">

        @foreach($kucingList as $k)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 rounded-4">

                    <img src="{{ asset('storage/' . $k->gambar) }}"
                        class="card-img-top rounded-top-4"
                        style="height: 220px; object-fit: cover;">

                    <div class="card-body text-center">

                        <h5 class="fw-bold">{{ $k->nama }}</h5>
                        <p class="text-muted small">{{ $k->ras ?? '-' }}</p>

                        {{-- ====== CEK STATUS ADOPTED ====== --}}
                        @if($k->status === 'adopted')
                            <button class="btn btn-danger w-100 mt-2" disabled>
                                Adopted
                            </button>
                        @elseif($k->status === 'available')
                            <button class="btn btn-primary w-100 mt-2"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modal{{ $k->id }}">
                                Adopsi
                            </button>
                        @else
                            <button class="btn btn-secondary w-100 mt-2" disabled>
                                Tidak Tersedia
                            </button>
                        @endif

                    </div>
                </div>
            </div>

            {{-- Modal --}}
            <div class="modal fade" id="modal{{ $k->id }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-4">

                        <div class="modal-header">
                            <h5 class="modal-title fw-bold">Konfirmasi Adopsi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body text-center">
                            <p class="fs-5">
                                Apakah Anda ingin mengadopsi
                                <b class="text-primary">{{ $k->nama }}</b>?
                            </p>
                        </div>

                        <div class="modal-footer justify-content-center">

                            {{-- Tombol dalam modal --}}
                            @if($k->status === 'adopted')
                                <button class="btn btn-danger px-4" disabled>
                                    Kucing Sudah Diadopsi
                                </button>
                            @elseif($k->status === 'available')
                                <a href="{{ route('adopter.quiz', $k->id) }}"
                                    class="btn btn-success px-4">
                                    Mulai Tes
                                </a>
                            @else
                                <button class="btn btn-secondary px-4" disabled>
                                    Tidak Tersedia
                                </button>
                            @endif

                        </div>

                    </div>
                </div>
            </div>

        @endforeach

        </div>

    @endif



    {{-- ====== MODE QUIZ (TETAP ADA, TIDAK DIHAPUS) ====== --}}
    @if(isset($kucing) && isset($soal))

        <h2 class="mb-4 fw-bold text-center">
            Tes Kelayakan Adopsi untuk <span class="text-primary">{{ $kucing->nama }}</span>
        </h2>

        <form method="POST" action="{{ route('adopter.quiz.submit', $kucing->id) }}">
            @csrf

            @foreach($soal as $s)
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">{{ $s->pertanyaan }}</h5>

                        {{-- TIPE ISIAN --}}
                        @if($s->tipe_soal === 'isian')
                            <textarea class="form-control"
                                    name="jawaban_{{ $s->id }}"
                                    rows="3"
                                    placeholder="Tulis jawaban Anda di sini..."
                                    required></textarea>

                        {{-- TIPE PILIHAN --}}
                        @elseif($s->tipe_soal === 'pilihan')
                            @foreach(['a','b','c','d'] as $opsi)
                                @if($s->{'opsi_'.$opsi})
                                    <div class="form-check mt-2">
                                        <input class="form-check-input"
                                            type="radio"
                                            name="jawaban_{{ $s->id }}"
                                            value="{{ strtoupper($opsi) }}"
                                            required>

                                        <label class="form-check-label">
                                            {{ $s->{'opsi_'.$opsi} }}
                                        </label>
                                    </div>
                                @endif
                            @endforeach

                        @endif

                    </div>
                </div>
            @endforeach

            <div class="text-center mt-4">
                <button class="btn btn-success px-5 py-2 fs-5">Kirim Jawaban</button>
            </div>

        </form>

    @endif

</div>

@endsection
