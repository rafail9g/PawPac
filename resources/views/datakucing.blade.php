@extends('layoutprovider')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Data Kucing</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
        + Tambah Kucing
    </button>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark text-center">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Umur</th>
                <th>Ras</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kucing as $index => $cat)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $cat->name }}</td>
                    <td>{{ $cat->age }} tahun</td>
                    <td>{{ $cat->breed }}</td>
                    <td>{{ Str::limit($cat->description, 50) }}</td>
                    <td class="text-center">
                        @if($cat->image)
                            <img src="{{ asset('storage/' . $cat->image) }}" alt="Kucing" width="70" class="rounded">
                        @else
                            <small class="text-muted">Tidak ada</small>
                        @endif
                    </td>
                    <td class="text-center">
                        <span class="badge {{ $cat->status == 'available' ? 'bg-success' : 'bg-secondary' }}">
                            {{ ucfirst($cat->status) }}
                        </span>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $cat->id }}">Edit</button>

                        <form action="{{ route('provider.kucing.destroy', $cat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kucing ini?')">
                            @csrf
                            {{-- <input type="file" name="image" accept="image/*"> --}}
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>

                {{-- Modal Edit --}}
                <div class="modal fade" id="editModal{{ $cat->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $cat->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('provider.kucing.update', $cat->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Data Kucing</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-2">
                                        <label>Nama</label>
                                        <input type="text" name="name" class="form-control" value="{{ $cat->name }}" required>
                                    </div>
                                    <div class="mb-2">
                                        <label>Umur</label>
                                        <input type="number" name="age" class="form-control" value="{{ $cat->age }}" required>
                                    </div>
                                    <div class="mb-2">
                                        <label>Ras</label>
                                        <input type="text" name="breed" class="form-control" value="{{ $cat->breed }}" required>
                                    </div>
                                    <div class="mb-2">
                                        <label>Deskripsi</label>
                                        <textarea name="description" class="form-control" rows="3">{{ $cat->description }}</textarea>
                                    </div>
                                    <div class="mb-2">
                                        <label>Gambar</label>
                                        <input type="file" name="image" class="form-control">
                                        @if($cat->image)
                                            <small class="text-muted">Gambar saat ini: {{ $cat->image }}</small>
                                        @endif
                                    </div>
                                    <div class="mb-2">
                                        <label>Status</label>
                                        <select name="status" class="form-select">
                                            <option value="available" {{ $cat->status == 'available' ? 'selected' : '' }}>Available</option>
                                            <option value="adopted" {{ $cat->status == 'adopted' ? 'selected' : '' }}>Adopted</option>
                                        </select>
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

    {{-- Modal Tambah --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('provider.kucing.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Kucing Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Umur</label>
                            <input type="number" name="age" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Ras</label>
                            <input type="text" name="breed" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Deskripsi</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-2">
                            <label>Gambar</label>
                            <input type="file" name="image" class="form-control">
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
