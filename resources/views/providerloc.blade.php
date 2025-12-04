@extends('layoutprovider')

@section('content')

<style>
    #map {
        height: 400px !important;
        width: 100%;
        min-height: 400px;
        z-index: 1;
    }

    .btn-save {
        background: linear-gradient(135deg, #c48a55, #a16c3e);
        color: white;
        border: none;
        padding: 14px 40px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s ease;
        cursor: pointer;
        width: 100%;
    }

    .btn-save:hover {
        background: linear-gradient(135deg, #a16c3e, #8b5e34);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(196, 138, 85, 0.3);
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

@if ($errors->any())
    <div class="alert alert-danger d-flex">
        <i class="bi bi-exclamation-circle me-2 mt-1"></i>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container mt-4">
    <h2 class="section-title fw-bold mb-3">Edit Lokasi Shelter</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('provider.location.updateAll') }}" method="POST">
        @csrf

        {{-- MAP --}}
        <div id="map" style="height: 500px;"></div>

        <input type="hidden" id="lat" name="lat" value="{{ $lokasi->lat }}">
        <input type="hidden" id="lng" name="lng" value="{{ $lokasi->lng }}">

        {{-- ALAMAT --}}
        <div class="mb-3 mt-3">
            <label class="form-label">Alamat Shelter</label>
            <input type="text" name="alamat" value="{{ $info->alamat }}" class="form-control" required>
        </div>

        {{-- NO HP --}}
        <div class="mb-3">
            <label class="form-label">No HP</label>
            <input type="text" name="no_hp" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '')"value="{{ old('no_hp', $info->no_hp ?? '') }}">
        </div>

        {{-- JAM --}}
        <div class="mb-3">
            <label class="form-label">Jam Buka</label>
            <input type="time" name="jam_buka" value="{{ $info->jam_buka }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jam Tutup</label>
            <input type="time" name="jam_tutup" value="{{ $info->jam_tutup }}" class="form-control" required>
        </div>

        <button class="btn-save">Simpan</button>
    </form>

</div>

@push('scripts')
    @vite('resources/js/map_provider.js')
@endpush

@endsection
