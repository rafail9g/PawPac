@extends('layout')

@section('content')
<div class="container mt-4">
    <h2>Kelola Data Adopter</h2>

    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <!-- Tombol buka modal -->
    <button class="btn btn-primary mt-3 mb-3" data-bs-toggle="modal" data-bs-target="#addAdopterModal">
        + Tambah Adopter
    </button>

    <table class="table table-bordered table-hover shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Alamat</th>
                <th>Lingkungan</th>
                <th style="width: 140px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($adopters as $adopter)
            <tr>
                <td>{{ $adopter->name }}</td>
                <td>{{ $adopter->email }}</td>
                <td>{{ $adopter->phone }}</td>
                <td>{{ $adopter->address }}</td>
                <td>{{ $adopter->living_environment }}</td>
                <td>
                    <a href="{{ route('admin.adopter.edit', $adopter->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.adopter.destroy', $adopter->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted">Belum ada adopter.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Modal Tambah Adopter -->
<div class="modal fade" id="addAdopterModal" tabindex="-1" aria-labelledby="addAdopterModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4 shadow">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="addAdopterModalLabel">Tambah Adopter Baru</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="{{ route('admin.adopter.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Nama</label>
              <input type="text" name="name" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Telepon</label>
              <input type="text" name="phone" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Alamat</label>
              <input type="text" name="address" class="form-control">
            </div>
            <div class="col-md-12">
              <label class="form-label">Lingkungan Tempat Tinggal</label>
              <textarea name="living_environment" class="form-control" rows="2"></textarea>
            </div>
            <div class="col-md-6">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Konfirmasi Password</label>
              <input type="password" name="password_confirmation" class="form-control" required>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
