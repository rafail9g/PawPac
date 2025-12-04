@extends('layoutadopter')
@section('content')

<style>
    .materi-header {
    background: linear-gradient(135deg, #f8e6cc, #ffe8c2);
    padding: 30px;
    border-radius: 16px;
    margin-bottom: 30px;
    text-align: center;
}

.materi-header h2 {
    color: #4b2e14;
    font-size: 32px;
    font-weight: bold;
    margin-bottom: 10px;
}

.materi-header p {
    color: #6b5030;
    font-size: 16px;
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
    transform: scale(1.02);
    color: white;
}

p{
    color: #6b5030;
}

h4{
    color: #4b2e14;
}

</style>
<div class="container mt-4">

    <div class="materi-header">
        <h2 style="font-size: 36px; font-weight: bold; margin-bottom: 10px;">
            Lokasi Shelter PawPac
        </h2>
        <p style="font-size: 16px; opacity: 0.9;">
            Ambil kucing yang anda adopsi di shelter kami!
        </p>
    </div>
<div id="map" style="height: 500px"></div>
<div class="card p-4 shadow-sm mb-4">
    <h4 class="fw-bold">PawPac Shelter</h4>
    <p><i class="bi bi-geo-alt-fill"></i> {{ $info->alamat }}</p>
    <p><i class="bi bi-telephone-fill"></i> {{ $info->no_hp }}</p>
    <p><i class="bi bi-clock-fill"></i>
        {{ \Carbon\Carbon::parse($info->jam_buka)->format('H:i') }}
         -
        {{ \Carbon\Carbon::parse($info->jam_tutup)->format('H:i') }}
    </p>
    {{-- <a href="https://maps.app.goo.gl/wLTj6tnRBEkbyvwb6" class="btn-feature" target="_blank">
        <i class="bi bi-map-fill"></i> Buka di Google Maps
    </a> --}}
</div>

@push('scripts')
<script>
    window.shelterLat = {{ $lat }};
    window.shelterLng = {{ $lng }};
</script>
@vite('resources/js/map.js')
@endpush

@endsection
