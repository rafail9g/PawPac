@extends('layoutadopter')

@section('content')

<div class="container mt-4">

    <h2 class="fw-bold mb-4 text-center">Status Pengajuan Adopsi</h2>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($riwayat->isEmpty())

        <div class="text-center mt-5">
            <h5 class="text-muted">Belum ada pengajuan adopsi.</h5>
            <a href="{{ route('adopter.pilih') }}" class="btn btn-primary mt-3">
                Pilih Kucing
            </a>
        </div>

    @else

        <div class="row justify-content-center">

            @foreach($riwayat as $r)

                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm rounded-4 border-0">

                        <div class="card-body">

                            <h5 class="fw-bold">{{ $r->kucing->nama }}</h5>

                            <p class="mt-2 mb-1">
                                <b>Nilai Quiz:</b> {{ $r->nilai_quiz }}
                            </p>

                            <p class="mb-1">
                                <b>Status:</b>
                                @if($r->status == "pending")
                                    <span class="badge bg-warning text-dark">Menunggu</span>

                                @elseif($r->status == "lulus")
                                    <span class="badge bg-success">Diterima</span>

                                @elseif($r->status == "tidak_lulus")
                                    <span class="badge bg-danger">Ditolak</span>

                                @else
                                    <span class="badge bg-secondary">-</span>
                                @endif
                            </p>

                            <p class="text-muted small mb-0">
                                Diajukan pada: {{ $r->created_at->format('d M Y H:i') }}
                            </p>

                        </div>

                    </div>
                </div>

            @endforeach

        </div>

    @endif

</div>

@endsection
