@extends('layoutadmin')

@section('content')

<style>
.adopsi-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 25px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    margin-bottom: 25px;
    transition: all 0.3s ease;
    border-left: 5px solid #c48a55;
}

.adopsi-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
}

.adopsi-header {
    display: flex;
    justify-content: space-between;
    align-items: start;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #f8e6cc;
}

.adopsi-title {
    font-size: 20px;
    font-weight: bold;
    color: #4b2e14;
    margin-bottom: 5px;
}

.adopsi-subtitle {
    color: #8b6f4e;
    font-size: 14px;
}

.badge-status-adopsi {
    padding: 8px 16px;
    border-radius: 25px;
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.badge-pending-adopsi {
    background: linear-gradient(135deg, #fff3cd, #ffeaa7);
    color: #856404;
}

.badge-lulus-adopsi {
    background: linear-gradient(135deg, #d4edda, #55efc4);
    color: #155724;
}

.badge-tidak-lulus-adopsi {
    background: linear-gradient(135deg, #f8d7da, #ff7675);
    color: #721c24;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
    margin-bottom: 20px;
}

.info-item-adopsi {
    background: #f8f9fa;
    padding: 12px;
    border-radius: 10px;
    border-left: 3px solid #c48a55;
}

.info-label-adopsi {
    font-size: 12px;
    color: #8b6f4e;
    font-weight: 600;
    display: block;
    margin-bottom: 5px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.info-value-adopsi {
    font-size: 15px;
    color: #4b2e14;
    font-weight: 600;
}

.btn-action-group {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.btn-adopsi {
    border: none;
    padding: 10px 20px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.btn-detail {
    background: linear-gradient(135deg, #2ecc71, #27ae60);
    color: white;
}

.btn-detail:hover {
    background: linear-gradient(135deg, #27ae60, #1e8449);
    transform: scale(1.05);
}

.btn-status {
    background: linear-gradient(135deg, #3F8BFF, #1F6FE5);
    color: white;
}

.btn-status:hover {
    background: linear-gradient(135deg, #1F6FE5, #1557C4);
    transform: scale(1.05);
}

.btn-edit-adopsi {
    background: linear-gradient(135deg, #f1c40f, #f39c12);
    color: white;
}

.btn-edit-adopsi:hover {
    background: linear-gradient(135deg, #d4ac0d, #b9770e);
    transform: scale(1.05);
}

.btn-delete-adopsi {
    background: linear-gradient(135deg, #ff7675, #d63031);
    color: white;
}

.btn-delete-adopsi:hover {
    background: linear-gradient(135deg, #d63031, #c0392b);
    transform: scale(1.05);
}

.section-header-adopsi {
    background: linear-gradient(135deg, #f8e6cc, #ffe8c2);
    padding: 25px;
    border-radius: 16px;
    margin-bottom: 30px;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
}

.section-title-adopsi {
    font-size: 32px;
    font-weight: bold;
    color: #4b2e14;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 12px;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
    text-align: center;
}

.stat-number {
    font-size: 36px;
    font-weight: bold;
    margin-bottom: 8px;
}

.stat-label {
    font-size: 14px;
    color: #8b6f4e;
    font-weight: 600;
    text-transform: uppercase;
}

.stat-pending { color: #f39c12; }
.stat-lulus { color: #27ae60; }
.stat-tidak { color: #e74c3c; }
.stat-total { color: #3498db; }

.filter-bar {
    background: white;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 25px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.empty-state-adopsi {
    text-align: center;
    padding: 80px 20px;
}

.empty-state-adopsi img {
    width: 250px;
    opacity: 0.6;
    margin-bottom: 20px;
}

.nilai-badge {
    background: linear-gradient(135deg, #F7C46C, #DFA45A);
    color: white;
    padding: 5px 12px;
    border-radius: 15px;
    font-size: 13px;
    font-weight: 600;
}
</style>

<div class="container-fluid mt-4">

    <div class="section-header-adopsi">
        <h2 class="section-title-adopsi">
            <span></span> Data Pengajuan Adopsi
        </h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number stat-total">{{ $adopsi->count() }}</div>
            <div class="stat-label">Total Pengajuan</div>
        </div>
        <div class="stat-card">
            <div class="stat-number stat-pending">{{ $adopsi->where('status', 'pending')->count() }}</div>
            <div class="stat-label">Pending</div>
        </div>
        <div class="stat-card">
            <div class="stat-number stat-lulus">{{ $adopsi->where('status', 'lulus')->count() }}</div>
            <div class="stat-label">Diterima</div>
        </div>
        <div class="stat-card">
            <div class="stat-number stat-tidak">{{ $adopsi->where('status', 'tidak_lulus')->count() }}</div>
            <div class="stat-label">Ditolak</div>
        </div>
    </div>

    <div class="filter-bar">
        <div class="row align-items-center">
            <div class="col-md-6">
                <input type="text" id="searchInput" class="form-control" placeholder="Cari berdasarkan nama kucing atau adopter...">
            </div>
            <div class="col-md-6">
                <select id="filterStatus" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="pending">Pending</option>
                    <option value="lulus">Diterima</option>
                    <option value="tidak_lulus">Ditolak</option>
                </select>
            </div>
        </div>
    </div>

    @if($adopsi->isEmpty())
        <div class="empty-state-adopsi">
            <img src="https://img.icons8.com/clouds/300/document.png" alt="Empty">
            <h4 class="text-muted">Belum ada pengajuan adopsi</h4>
            <p class="text-muted">Pengajuan adopsi akan muncul di sini</p>
        </div>
    @else
        <div class="row" id="adopsiContainer">
            @foreach ($adopsi as $a)
                <div class="col-lg-6 col-xl-4 adopsi-item"
                     data-kucing="{{ strtolower($a->kucing->name) }}"
                     data-adopter="{{ strtolower($a->adopter->name) }}"
                     data-status="{{ $a->status }}">
                    <div class="adopsi-card">
                        <div class="adopsi-header">
                            <div>
                                <div class="adopsi-title">{{ $a->kucing->name }}</div>
                                <div class="adopsi-subtitle">ID: #{{ str_pad($a->id, 4, '0', STR_PAD_LEFT) }}</div>
                            </div>
                            <span class="badge-status-adopsi
                                @if($a->status == 'pending') badge-pending-adopsi
                                @elseif($a->status == 'lulus') badge-lulus-adopsi
                                @else badge-tidak-lulus-adopsi
                                @endif">
                                @if($a->status == 'pending') Pending
                                @elseif($a->status == 'lulus') Diterima
                                @else Ditolak
                                @endif
                            </span>
                        </div>

                        <div class="info-grid">
                            <div class="info-item-adopsi">
                                <span class="info-label-adopsi">Adopter</span>
                                <span class="info-value-adopsi">{{ $a->adopter->name }}</span>
                            </div>

                            <div class="info-item-adopsi">
                                <span class="info-label-adopsi">Email</span>
                                <span class="info-value-adopsi" style="font-size: 13px;">{{ Str::limit($a->adopter->email, 20) }}</span>
                            </div>

                            <div class="info-item-adopsi">
                                <span class="info-label-adopsi">Tanggal</span>
                                <span class="info-value-adopsi">{{ $a->created_at->format('d M Y') }}</span>
                            </div>

                            <div class="info-item-adopsi">
                                <span class="info-label-adopsi">Nilai Quiz</span>
                                <span class="info-value-adopsi">
                                    @if($a->nilai_quiz !== null)
                                        <span class="nilai-badge">{{ $a->nilai_quiz }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="btn-action-group">
                            <button class="btn-adopsi btn-detail" onclick="showDetail({{ $a->id }})">
                                Detail
                            </button>

                            <button class="btn-adopsi btn-status" onclick="openStatusModal({{ $a->id }}, '{{ $a->status }}')">
                                Status
                            </button>

                            <button class="btn-adopsi btn-edit-adopsi" onclick="openEditModal({{ $a->id }})">
                                Edit
                            </button>

                            <form action="{{ route('admin.adopsi.destroy', $a->id) }}" method="POST" style="display: inline;"
                                  onsubmit="return confirm('Yakin ingin menghapus pengajuan ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn-adopsi btn-delete-adopsi" type="submit">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>

<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 16px;">
            <div class="modal-header" style="background: linear-gradient(135deg, #f8e6cc, #ffe8c2);">
                <h5 class="modal-title fw-bold" style="color: #4b2e14;">Detail Pengajuan Adopsi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="detailContent">
                <p class="text-center text-muted">Memuat data...</p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="statusModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form id="statusForm" method="POST">
            @csrf
            <div class="modal-content" style="border-radius: 16px;">
                <div class="modal-header" style="background: linear-gradient(135deg, #f8e6cc, #ffe8c2);">
                    <h5 class="modal-title fw-bold" style="color: #4b2e14;">Update Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="fw-semibold mb-2">Status Pengajuan</label>
                        <select name="status" id="statusSelect" class="form-select" required>
                            <option value="pending">Pending</option>
                            <option value="lulus">Diterima</option>
                            <option value="tidak_lulus">Ditolak</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content" style="border-radius: 16px;">
                <div class="modal-header" style="background: linear-gradient(135deg, #f8e6cc, #ffe8c2);">
                    <h5 class="modal-title fw-bold" style="color: #4b2e14;">Edit Pengajuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="editContent">
                    <p class="text-center text-muted">Memuat data...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('searchInput').addEventListener('keyup', filterData);
document.getElementById('filterStatus').addEventListener('change', filterData);

function filterData() {
    const searchValue = document.getElementById('searchInput').value.toLowerCase();
    const statusValue = document.getElementById('filterStatus').value;
    const items = document.querySelectorAll('.adopsi-item');

    items.forEach(item => {
        const kucing = item.dataset.kucing;
        const adopter = item.dataset.adopter;
        const status = item.dataset.status;

        const matchSearch = kucing.includes(searchValue) || adopter.includes(searchValue);
        const matchStatus = statusValue === '' || status === statusValue;

        item.style.display = (matchSearch && matchStatus) ? 'block' : 'none';
    });
}

function showDetail(id) {
    fetch(`/admin/adopsi/${id}/json`)
        .then(res => res.json())
        .then(data => {
            document.getElementById('detailContent').innerHTML = `
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <strong>Kucing:</strong><br>
                        <span class="text-primary fs-5">${data.kucing.name}</span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>👤 Adopter:</strong><br>
                        <span class="text-primary fs-5">${data.adopter.name}</span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Email:</strong><br>
                        ${data.adopter.email}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Telepon:</strong><br>
                        ${data.adopter.phone || '-'}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Alamat:</strong><br>
                        ${data.adopter.address || '-'}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Lingkungan:</strong><br>
                        ${data.adopter.living_environment || '-'}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Nilai Quiz:</strong><br>
                        <span class="badge bg-primary">${data.nilai_quiz ?? '-'}</span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Status:</strong><br>
                        <span class="badge ${data.status == 'lulus' ? 'bg-success' : data.status == 'pending' ? 'bg-warning' : 'bg-danger'}">
                            ${data.status.toUpperCase()}
                        </span>
                    </div>
                    <div class="col-12 mb-3">
                        <strong>Tanggal Pengajuan:</strong><br>
                        ${new Date(data.created_at).toLocaleString('id-ID')}
                    </div>
                </div>
            `;
            new bootstrap.Modal(document.getElementById('detailModal')).show();
        });
}

function openStatusModal(id, currentStatus) {
    document.getElementById('statusForm').action = `/admin/adopsi/${id}/status`;
    document.getElementById('statusSelect').value = currentStatus;
    new bootstrap.Modal(document.getElementById('statusModal')).show();
}

function openEditModal(id) {
    fetch(`/admin/adopsi/${id}/json`)
        .then(res => res.json())
        .then(data => {
            document.getElementById('editForm').action = `/admin/adopsi/${id}`;

            Promise.all([
                fetch('/admin/adopsi/adopters').then(r => r.json()),
                fetch('/admin/adopsi/kucing').then(r => r.json())
            ]).then(([adopters, kucingList]) => {
                document.getElementById('editContent').innerHTML = `
                    <div class="mb-3">
                        <label class="fw-semibold">👤 Adopter</label>
                        <select name="adopter_id" class="form-select" required>
                            ${adopters.map(a => `<option value="${a.id}" ${a.id == data.adopter_id ? 'selected' : ''}>${a.name}</option>`).join('')}
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="fw-semibold"> Kucing</label>
                        <select name="kucing_id" class="form-select" required>
                            ${kucingList.map(k => `<option value="${k.id}" ${k.id == data.kucing_id ? 'selected' : ''}>${k.name}</option>`).join('')}
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="fw-semibold">Nilai Quiz</label>
                        <input type="number" name="nilai_quiz" class="form-control" value="${data.nilai_quiz ?? ''}">
                    </div>
                    <div class="mb-3">
                        <label class="fw-semibold">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="pending" ${data.status == 'pending' ? 'selected' : ''}>Pending</option>
                            <option value="lulus" ${data.status == 'lulus' ? 'selected' : ''}>Diterima</option>
                            <option value="tidak_lulus" ${data.status == 'tidak_lulus' ? 'selected' : ''}>Ditolak</option>
                        </select>
                    </div>
                `;
                new bootstrap.Modal(document.getElementById('editModal')).show();
            });
        });
}
</script>

@endsection
