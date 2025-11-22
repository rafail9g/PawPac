@extends('layoutprovider')

@section('content')

@if(isset($pengajuan))
    <h3>Daftar Pengajuan Adopsi</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kucing</th>
                <th>Adopter</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($pengajuan as $p)
            <tr>
                <td>{{ $p->kucing->nama }}</td>
                <td>{{ $p->adopter->nama }}</td>
                <td>{{ $p->status ?? '-' }}</td>
                <td>
                    <a href="{{ route('provider.adoption.review', $p->id) }}" class="btn btn-primary btn-sm">
                        Review
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif


@if(isset($adopsi))
    <h3>Review Pengajuan Adopsi</h3>

    <h5>Kucing: {{ $adopsi->kucing->nama }}</h5>
    <h5>Adopter: {{ $adopsi->adopter->nama }}</h5>

    <form method="POST" action="{{ route('provider.nilai', $adopsi->id) }}">
        @csrf

        @foreach($adopsi->jawaban as $j)
            <div class="card mt-3">
                <div class="card-body">
                    <b>{{ $j->soal->pertanyaan }}</b>

                    <p class="mt-2">
                        Jawaban User: <br>
                        <span class="text-primary">{{ $j->jawaban }}</span>
                    </p>

                    @if($j->soal->tipe == 'pg')
                        <span class="badge bg-success">Pilihan Ganda — otomatis</span>
                    @else
                        <label class="mt-2">Nilai Provider:</label>
                        <select name="nilai_{{ $j->id }}" class="form-select w-25">
                            <option value="1">Benar</option>
                            <option value="0">Salah</option>
                        </select>
                    @endif

                </div>
            </div>
        @endforeach

        <div class="mt-4">
            <label>Status Akhir:</label>
            <select name="status" class="form-control">
                <option value="lulus">Diterima</option>
                <option value="tidak_lulus">Tidak Lulus</option>
            </select>
        </div>

        <button class="btn btn-success mt-3">Simpan Penilaian</button>
    </form>
@endif

@endsection
