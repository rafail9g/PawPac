@extends('layoutadmin')

@section('content')

<style>
.history-card {
    background: #ffffff;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    transition: 0.3s;
}

.history-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
}

.badge-history-lulus {
    background: linear-gradient(135deg, #2ecc71, #27ae60);
    color: white;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.badge-history-tidak {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.btn-action-history {
    border: none;
    padding: 6px 14px;
    border-radius: 8px;
    font-weight: 600;
    transition: 0.3s;
    font-size: 13px;
}

.btn-edit-history {
    background: linear-gradient(135deg, #f39c12, #e67e22);
    color: white;
}

.btn-edit-history:hover {
    background: linear-gradient(135deg, #e67e22, #d35400);
    transform: scale(1.05);
}

.btn-delete-history {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
}

.btn-delete-history:hover {
    background: linear-gradient(135deg, #c0392b, #922b21);
    transform: scale(1.05);
}

.section-header {
    background: linear-gradient(135deg, #f8e6cc, #ffe8c2);
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 30px;
}

.section-title {
    font-size: 28px;
    font-weight: bold;
    color: #4b2e14;
    margin: 0;
}

.info-row {
    display: flex;
    margin-bottom: 10px;
}

.info-label {
    font-weight: 600;
    color: #4b2e14;
    width: 130px;
}

.info-value {
    color: #6b5030;
}

.alert-warning-custom {
    background-color: #fff3cd;
    border: 1px solid #ffc107;
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 20px;
}
</style>

<div class="container mt-4">

    <div class="section-header">
        <h2 class="section-title">History Adopsi</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($history->isEmpty())
        <div class="text-center py-5">
            <img src="https://img.icons8.com/clouds/200/history.png" alt="Empty">
            <h5 class="text-muted mt-3">Belum ada history adopsi</h5>
        </div>
    @else
        <div class="row">
            @foreach ($history as $h)
                @if($h->adopsi && $h->adopsi->kucing && $h->adopsi->adopter)
                    <div class="col-md-6 col-lg-4">
                        <div class="history-card">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h6 class="fw-bold mb-0" style="color: #4b2e14;">{{ $h->adopsi->kucing->name }}</h6>
                                <span class="{{ $h->status == 'lulus' ? 'badge-history-lulus' : 'badge-history-tidak' }}">
                                    {{ $h->status == 'lulus' ? '✓ Lulus' : '✗ Tidak Lulus' }}
                                </span>
                            </div>

                            <div class="info-row">
                                <span class="info-label">👤 Adopter:</span>
                                <span class="info-value">{{ $h->adopsi->adopter->name }}</span>
                            </div>

                            <div class="info-row">
                                <span class="info-label">Tanggal:</span>
                                <span class="info-value">{{ $h->created_at->format('d M Y, H:i') }}</span>
                            </div>

                            <div class="info-row">
                                <span class="info-label">Catatan:</span>
                                <span class="info-value">{{ Str::limit($h->catatan ?? '-', 30) }}</span>
                            </div>

                            <div class="d-flex gap-2 mt-3">
                                <button class="btn-action-history btn-edit-history flex-fill"
                                        onclick="openEditHistory({{ $h->id }})">
                                    <i class="bi bi-pencil"></i> Edit
                                </button>

                                <form action="{{ route('admin.history.destroy', $h->id) }}" method="POST" class="flex-fill"
                                      onsubmit="return confirm('Yakin ingin menghapus history ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-action-history btn-delete-history w-100">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-6 col-lg-4">
                        <div class="history-card" style="border-left: 5px solid #dc3545;">
                            <div class="alert-warning-custom">
                                <strong>⚠️ Data Tidak Lengkap</strong>
                                <p class="mb-0 mt-2" style="font-size: 14px;">
                                    History ID: {{ $h->id }}<br>
                                    Status: {{ $h->status }}<br>
                                    Catatan: {{ $h->catatan ?? '-' }}<br>
                                    <small class="text-muted">Data adopsi terkait mungkin telah dihapus</small>
                                </p>
                            </div>

                            <form action="{{ route('admin.history.destroy', $h->id) }}" method="POST" class="mt-3"
                                  onsubmit="return confirm('Yakin ingin menghapus history ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn-action-history btn-delete-history w-100">
                                    <i class="bi bi-trash"></i> Hapus Data Rusak
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @endif

    <div class="modal fade" id="editHistoryModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="editHistoryForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content" style="border-radius: 16px;">
                    <div class="modal-header" style="background: linear-gradient(135deg, #f8e6cc, #ffe8c2);">
                        <h5 class="modal-title fw-bold" style="color: #4b2e14;">Edit History</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" id="editHistoryBody">
                        <p class="text-center text-muted">Memuat data...</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-success" type="submit">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
function openEditHistory(id) {
    fetch(`/admin/history/${id}/json`)
        .then(res => res.json())
        .then(data => {
            document.getElementById('editHistoryForm').action = `/admin/history/${id}`;

            document.getElementById('editHistoryBody').innerHTML = `
                <div class="mb-3">
                    <label class="fw-semibold">Catatan</label>
                    <textarea name="catatan" class="form-control" rows="3">${data.catatan ?? ''}</textarea>
                </div>
                <div class="mb-3">
                    <label class="fw-semibold">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="lulus" ${data.status == 'lulus' ? 'selected' : ''}>✓ Lulus</option>
                        <option value="tidak_lulus" ${data.status == 'tidak_lulus' ? 'selected' : ''}>✗ Tidak Lulus</option>
                    </select>
                </div>
            `;

            new bootstrap.Modal(document.getElementById('editHistoryModal')).show();
        })
        .catch(err => {
            alert('Gagal memuat data history');
            console.error(err);
        });
}
</script>
@endsection
