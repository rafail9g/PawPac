@extends('layoutadmin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Data Adopter</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
        + Tambah Adopter
    </button>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark text-center">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Lingkungan Hidup</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($adopters as $index => $adopter)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $adopter->name }}</td>
                    <td>{{ $adopter->email }}</td>
                    <td>{{ $adopter->address }}</td>
                    <td>{{ $adopter->phone }}</td>
                    <td>{{ $adopter->living_environment }}</td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-warning"
                            data-bs-toggle="modal"
                            data-bs-target="#editModal{{ $adopter->id }}">
                            Edit
                        </button>

                        {{-- Tombol hapus --}}
                        <form action="{{ route('admin.adopter.destroy', $adopter->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Yakin ingin menghapus adopter ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>

                <div class="modal fade" id="editModal{{ $adopter->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $adopter->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('admin.adopter.update', $adopter->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $adopter->id }}">Edit Adopter</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-2">
                                        <label>Nama</label>
                                        <input type="text" name="name" class="form-control" value="{{ $adopter->name }}" required>
                                    </div>
                                    <div class="mb-2">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" value="{{ $adopter->email }}" required>
                                    </div>
                                    <div class="mb-2">
                                        <label>Alamat</label>
                                        <input type="text" name="address" class="form-control" value="{{ $adopter->address }}">
                                    </div>
                                    <div class="mb-2">
                                        <label>Telepon</label>
                                        <input type="text" name="phone" class="form-control" value="{{ $adopter->phone }}">
                                    </div>
                                    <div class="mb-2">
                                        <label>Lingkungan Hidup</label>
                                        <input type="text" name="living_environment" class="form-control" value="{{ $adopter->living_environment }}">
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
        </tbody>
    </table>

    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.adopter.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Tambah Adopter Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Alamat</label>
                            <input type="text" name="address" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label>Telepon</label>
                            <input type="text" name="phone" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label>Lingkungan Hidup</label>
                            <input type="text" name="living_environment" class="form-control">
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
