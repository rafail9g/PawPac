@extends('layoutadmin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Data Materi Perawatan Kucing</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">+ Tambah Materi</button>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark text-center">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Isi</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($materi as $i => $m)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>{{ $m->judul }}</td>
                    <td>{{ $m->kategori ?? '-' }}</td>
                    <td>{{ Str::limit($m->isi, 60) }}</td>
                    <td>
                        @if($m->gambar)
                            <img src="{{ $m->gambar }}" width="80" height="60" class="rounded">
                        @else
                            <small>Tidak ada</small>
                        @endif
                    </td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $m->id }}">Edit</button>
                        <form action="{{ route('admin.materi.destroy', $m->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus materi ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>

                <div class="modal fade" id="editModal{{ $m->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <form action="{{ route('admin.materi.update', $m->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Materi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-2">
                                        <label>Judul</label>
                                        <input type="text" name="judul" value="{{ $m->judul }}" class="form-control" required>
                                    </div>
                                    <div class="mb-2">
                                        <label>Isi</label>
                                        <textarea name="isi" class="form-control" rows="3" required>{{ $m->isi }}</textarea>
                                    </div>
                                    <div class="mb-2">
                                        <label>Kategori</label>
                                        <input type="text" name="kategori" value="{{ $m->kategori }}" class="form-control">
                                    </div>
                                    <div class="mb-2">
                                        <label>Gambar (URL)</label>
                                        <input type="text" name="gambar" value="{{ $m->gambar }}" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button class="btn btn-success" type="submit">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>

    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('admin.materi.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Materi Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label>Judul</label>
                            <input type="text" name="judul" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Isi</label>
                            <textarea name="isi" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-2">
                            <label>Kategori</label>
                            <input type="text" name="kategori" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label>Gambar (URL)</label>
                            <input type="text" name="gambar" class="form-control">
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
@endsection
