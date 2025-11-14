@extends('layoutadmin')

@section('content')
<style>
.btn-crud {
    border: none;
    color: #fff;
    padding: 8px 14px;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.25s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.btn-crud i { font-size: 16px; }
.btn-add { background: linear-gradient(135deg, #2ecc71, #27ae60); box-shadow: 0 3px 6px rgba(46, 204, 113, 0.4); }
.btn-add:hover { background: linear-gradient(135deg, #27ae60, #1e8449); transform: scale(1.05); }
.btn-edit { background: linear-gradient(135deg, #f1c40f, #f39c12); box-shadow: 0 3px 6px rgba(243, 156, 18, 0.4); }
.btn-edit:hover { background: linear-gradient(135deg, #d4ac0d, #b9770e); transform: scale(1.05); }
.btn-delete { background: linear-gradient(135deg, #e74c3c, #c0392b); box-shadow: 0 3px 6px rgba(192, 57, 43, 0.4); }
.btn-delete:hover { background: linear-gradient(135deg, #c0392b, #922b21); transform: scale(1.05); }

.card-data {
    background: #ffffff;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.1);
}
.table th { background-color: #3b3b3b !important; color: white !important; }
</style>

<div class="container mt-4">
    <h2 class="mb-4 text-center">Data Adopter</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card-data">
        <table class="table table-bordered table-striped align-middle">
            <thead class="text-center">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Lingkungan Hidup</th>
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
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4 gap-3">
            <button class="btn-crud btn-add" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="bi bi-person-plus-fill"></i> Tambah
            </button>

            <button class="btn-crud btn-edit" data-bs-toggle="modal" data-bs-target="#editChooseModal">
                <i class="bi bi-pencil-square"></i> Edit
            </button>

            <button class="btn-crud btn-delete" data-bs-toggle="modal" data-bs-target="#deleteChooseModal">
                <i class="bi bi-trash3-fill"></i> Hapus
            </button>
        </div>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('admin.adopter.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Adopter Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2"><label>Nama</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-2"><label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-2"><label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-2"><label>Alamat</label>
                            <input type="text" name="address" class="form-control">
                        </div>
                        <div class="mb-2"><label>Telepon</label>
                            <input type="text" name="phone" class="form-control">
                        </div>
                        <div class="mb-2"><label>Lingkungan Hidup</label>
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

    <div class="modal fade" id="editChooseModal" tabindex="-1">
        <div class="modal-dialog">
            <form id="editSelectForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pilih Adopter untuk Diedit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label>Pilih adopter:</label>
                        <select id="editSelect" class="form-select">
                            <option value="">-- Pilih Adopter --</option>
                            @foreach ($adopters as $adopter)
                                <option value="{{ $adopter->id }}">{{ $adopter->id }} - {{ $adopter->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-warning" onclick="openEditModal()">Edit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="deleteChooseModal" tabindex="-1">
        <div class="modal-dialog">
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pilih Adopter untuk Dihapus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label>Pilih adopter:</label>
                        <select id="deleteSelect" class="form-select">
                            <option value="">-- Pilih Adopter --</option>
                            @foreach ($adopters as $adopter)
                                <option value="{{ $adopter->id }}">{{ $adopter->id }} - {{ $adopter->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger" onclick="submitDelete()">Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="editModalDynamic" tabindex="-1">
        <div class="modal-dialog">
            <form id="editFormDynamic" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data Adopter</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" id="editFormBody">
                        <p class="text-center text-muted">Memuat data...</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-success" type="submit">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<form id="editFormDynamic" method="POST">
    @csrf
    @method('PUT')
<script>
function openEditModal() {
    const id = document.getElementById('editSelect').value;
    if (!id) return alert('Pilih adopter dulu!');
    fetch(`/admin/adopter/${id}/json`)
        .then(res => res.json())
        .then(data => {
            document.getElementById('editFormDynamic').action = `/admin/adopter/${id}`;
            document.getElementById('editFormBody').innerHTML = `
                <div class="mb-2"><label>Nama</label>
                    <input type="text" name="name" class="form-control" value="${data.name}" required>
                </div>
                <div class="mb-2"><label>Email</label>
                    <input type="email" name="email" class="form-control" value="${data.email}" required>
                </div>
                <div class="mb-2"><label>Alamat</label>
                    <input type="text" name="address" class="form-control" value="${data.address ?? ''}">
                </div>
                <div class="mb-2"><label>Telepon</label>
                    <input type="text" name="phone" class="form-control" value="${data.phone ?? ''}">
                </div>
                <div class="mb-2"><label>Lingkungan Hidup</label>
                    <input type="text" name="living_environment" class="form-control" value="${data.living_environment ?? ''}">
                </div>
            `;
            new bootstrap.Modal(document.getElementById('editModalDynamic')).show();
        });
}

function submitDelete() {
    const id = document.getElementById('deleteSelect').value;
    if (!id) return alert('Pilih adopter dulu!');
    const form = document.getElementById('deleteForm');
    form.action = `/admin/adopter/${id}`;
    form.submit();
}
</script>
@endsection
