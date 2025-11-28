@extends('layoutprovider')

@section('content')

<style>
.kucing-card {
    background: #ffffff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
    margin-bottom: 25px;
}

.kucing-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.kucing-img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    border-bottom: 3px solid #c48a55;
}

.kucing-body {
    padding: 20px;
}

.kucing-name {
    font-size: 20px;
    font-weight: bold;
    color: #4b2e14;
    margin-bottom: 8px;
}

.kucing-info {
    display: flex;
    align-items: center;
    margin-bottom: 8px;
    color: #6b5030;
    font-size: 14px;
}

.kucing-info i {
    margin-right: 8px;
    color: #c48a55;
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

.btn-action {
    border: none;
    padding: 8px 16px;
    border-radius: 8px;
    font-weight: 600;
    transition: 0.3s;
    margin: 0 4px;
}

.btn-edit-kucing {
    background: linear-gradient(135deg, #f39c12, #e67e22);
    color: white;
}

.btn-edit-kucing:hover {
    background: linear-gradient(135deg, #e67e22, #d35400);
    transform: scale(1.05);
}

.btn-delete-kucing {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
}

.btn-delete-kucing:hover {
    background: linear-gradient(135deg, #c0392b, #922b21);
    transform: scale(1.05);
}

.btn-add-main {
    background: linear-gradient(135deg, #3498db, #2980b9);
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 10px;
    font-weight: 600;
    transition: 0.3s;
}

.btn-add-main:hover {
    background: linear-gradient(135deg, #2980b9, #21618c);
    transform: scale(1.05);
}

.section-header {
    background: linear-gradient(135deg, #f8e6cc, #ffe8c2);
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.section-title {
    font-size: 28px;
    font-weight: bold;
    color: #4b2e14;
    margin: 0;
}

.kucing-desc {
    color: #6b5030;
    font-size: 13px;
    line-height: 1.5;
    margin-top: 10px;
    max-height: 60px;
    overflow: hidden;
    text-overflow: ellipsis;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
}

.empty-state img {
    width: 200px;
    opacity: 0.6;
}
</style>

<div class="container mt-4">

    <div class="section-header">
        <h2 class="section-title">Data Kucing</h2>
        <button class="btn btn-add-main" data-bs-toggle="modal" data-bs-target="#addModal">
            Tambah Kucing Baru
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($kucing->isEmpty())
        <div class="empty-state">
            <img src="https://img.icons8.com/clouds/200/cat.png" alt="No Cats">
            <h5 class="text-muted mt-3">Belum ada data kucing</h5>
            <p class="text-muted">Tambahkan kucing pertama Anda!</p>
        </div>
    @else
        <div class="row">
            @foreach ($kucing as $cat)
                <div class="col-md-6 col-lg-4">
                    <div class="kucing-card">
                        @if($cat->image)
                            <img src="{{ asset('storage/' . $cat->image) }}" class="kucing-img" alt="{{ $cat->name }}">
                        @else
                            <img src="https://via.placeholder.com/400x220/f8e6cc/4b2e14?text=No+Image" class="kucing-img" alt="No Image">
                        @endif

                        <div class="kucing-body">
                            <h5 class="kucing-name">{{ $cat->name }}</h5>

                            <div class="kucing-info">
                                <i class="bi bi-calendar3"></i>
                                <span>{{ $cat->age }} tahun</span>
                            </div>

                            <div class="kucing-info">
                                <i class="bi bi-award"></i>
                                <span>{{ $cat->breed }}</span>
                            </div>

                            <p class="kucing-desc">{{ $cat->description }}</p>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="{{ $cat->status == 'available' ? 'badge-available' : 'badge-adopted' }}">
                                    {{ $cat->status == 'available' ? '✓ Available' : '✗ Adopted' }}
                                </span>

                                <div>
                                    <button class="btn-action btn-edit-kucing" data-bs-toggle="modal" data-bs-target="#editModal{{ $cat->id }}">
                                         Edit
                                    </button>

                                    <form action="{{ route('provider.kucing.destroy', $cat->id) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus {{ $cat->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-action btn-delete-kucing"> Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="editModal{{ $cat->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <form action="{{ route('provider.kucing.update', $cat->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-content" style="border-radius: 16px;">
                                <div class="modal-header" style="background: linear-gradient(135deg, #f8e6cc, #ffe8c2);">
                                    <h5 class="modal-title fw-bold" style="color: #4b2e14;">Edit Data Kucing</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="fw-semibold">Nama</label>
                                        <input type="text" name="name" class="form-control" value="{{ $cat->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="fw-semibold">Umur (tahun)</label>
                                        <input type="number" name="age" class="form-control" value="{{ $cat->age }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="fw-semibold">Ras</label>
                                        <input type="text" name="breed" class="form-control" value="{{ $cat->breed }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="fw-semibold">Deskripsi</label>
                                        <textarea name="description" class="form-control" rows="3">{{ $cat->description }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="fw-semibold">Gambar</label>
                                        <input type="file" name="image" class="form-control" accept="image/*">
                                        @if($cat->image)
                                            <small class="text-muted">Gambar saat ini: {{ basename($cat->image) }}</small>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label class="fw-semibold">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="available" {{ $cat->status == 'available' ? 'selected' : '' }}>Available</option>
                                            <option value="adopted" {{ $cat->status == 'adopted' ? 'selected' : '' }}>Adopted</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button class="btn btn-success" type="submit">Simpan Perubahan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{ route('provider.kucing.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content" style="border-radius: 16px;">
                    <div class="modal-header" style="background: linear-gradient(135deg, #f8e6cc, #ffe8c2);">
                        <h5 class="modal-title fw-bold" style="color: #4b2e14;"> Tambah Kucing Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="fw-semibold">Nama</label>
                            <input type="text" name="name" class="form-control" required placeholder="Nama kucing">
                        </div>
                        <div class="mb-3">
                            <label class="fw-semibold">Umur (tahun)</label>
                            <input type="number" name="age" class="form-control" required placeholder="Contoh: 2">
                        </div>
                        <div class="mb-3">
                            <label class="fw-semibold">Ras</label>
                            <input type="text" name="breed" class="form-control" required placeholder="Contoh: Persian">
                        </div>
                        <div class="mb-3">
                            <label class="fw-semibold">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Deskripsi tentang kucing"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="fw-semibold">Gambar</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

@endsection
