@extends('layoutadmin')

@section('content')

<style>
.quiz-card {
    background: white;
    border-radius: 16px;
    padding: 25px;
    margin-bottom: 20px;
    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.1);
    border-left: 5px solid #c48a55;
    transition: transform 0.3s ease;
}

.quiz-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
}

.quiz-type-badge {
    display: inline-block;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 15px;
}

.badge-pg {
    background: linear-gradient(135deg, #d1ecf1, #bee5eb);
    color: #0c5460;
}

.badge-isian {
    background: linear-gradient(135deg, #fff3cd, #ffeaa7);
    color: #856404;
}

.quiz-question {
    font-size: 18px;
    font-weight: bold;
    color: #4b2e14;
    margin-bottom: 15px;
}

.quiz-options {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 10px;
    margin-bottom: 15px;
}

.option-item {
    padding: 8px 0;
    color: #6b5030;
}

.correct-answer {
    background: #d4edda;
    padding: 10px;
    border-radius: 8px;
    color: #155724;
    font-weight: 600;
    margin-bottom: 15px;
}

.btn-action-quiz {
    border: none;
    padding: 8px 16px;
    border-radius: 8px;
    font-weight: 600;
    transition: 0.3s;
    margin: 0 4px;
}

.btn-edit-quiz {
    background: linear-gradient(135deg, #f39c12, #e67e22);
    color: white;
}

.btn-edit-quiz:hover {
    background: linear-gradient(135deg, #e67e22, #d35400);
    transform: scale(1.05);
}

.btn-delete-quiz {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
}

.btn-delete-quiz:hover {
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

.form-section {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 10px;
    margin-bottom: 15px;
}

.type-selector {
    display: flex;
    gap: 15px;
    margin-bottom: 15px;
}

.type-option {
    flex: 1;
    padding: 15px;
    border: 2px solid #dee2e6;
    border-radius: 10px;
    cursor: pointer;
    text-align: center;
    transition: all 0.3s ease;
}

.type-option:hover {
    border-color: #c48a55;
}

.type-option.active {
    border-color: #c48a55;
    background: linear-gradient(135deg, #f8e6cc, #ffe8c2);
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
}
</style>

<div class="container mt-4">

    <div class="section-header">
        <h2 class="section-title">📝 Kelola Soal Quiz Adopsi</h2>
        <button class="btn btn-add-main" data-bs-toggle="modal" data-bs-target="#addModal">
            ➕ Tambah Soal Baru
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($soal->isEmpty())
        <div class="empty-state">
            <img src="https://img.icons8.com/clouds/200/test.png" alt="No Quiz">
            <h5 class="text-muted mt-3">Belum ada soal quiz</h5>
            <p class="text-muted">Tambahkan soal untuk tes kelayakan adopsi</p>
        </div>
    @else
        <div class="row">
            @foreach ($soal as $index => $s)
                <div class="col-md-6">
                    <div class="quiz-card">

                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="quiz-type-badge {{ $s->tipe == 'pg' ? 'badge-pg' : 'badge-isian' }}">
                                {{ $s->tipe == 'pg' ? '✓ Pilihan Ganda' : '✍️ Isian' }}
                            </span>
                            <span class="text-muted" style="font-size: 14px;">Soal #{{ $index + 1 }}</span>
                        </div>

                        <div class="quiz-question">
                            {{ $s->pertanyaan }}
                        </div>

                        @if($s->tipe == 'pg')
                            <div class="quiz-options">
                                <div class="option-item">A. {{ $s->opsi_a }}</div>
                                <div class="option-item">B. {{ $s->opsi_b }}</div>
                                <div class="option-item">C. {{ $s->opsi_c }}</div>
                                <div class="option-item">D. {{ $s->opsi_d }}</div>
                            </div>

                            @if($s->jawaban_benar)
                                <div class="correct-answer">
                                    ✓ Jawaban Benar: {{ $s->jawaban_benar }}
                                </div>
                            @endif
                        @else
                            <div class="alert alert-info">
                                <small>Jawaban akan dinilai manual oleh provider</small>
                            </div>
                        @endif

                        <div class="d-flex gap-2">
                            <button class="btn-action-quiz btn-edit-quiz flex-fill"
                                    onclick="openEditModal({{ $s->id }})">
                                ✏️ Edit
                            </button>

                            <form action="{{ route('admin.quiz.destroy', $s->id) }}"
                                  method="POST"
                                  class="flex-fill"
                                  onsubmit="return confirm('Yakin ingin menghapus soal ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn-action-quiz btn-delete-quiz w-100">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>

<!-- Modal Tambah -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form action="{{ route('admin.quiz.store') }}" method="POST">
            @csrf
            <div class="modal-content" style="border-radius: 16px;">
                <div class="modal-header" style="background: linear-gradient(135deg, #f8e6cc, #ffe8c2);">
                    <h5 class="modal-title fw-bold" style="color: #4b2e14;">➕ Tambah Soal Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label class="fw-semibold mb-2">Tipe Soal</label>
                        <div class="type-selector">
                            <div class="type-option active" onclick="selectType('pg', 'add')">
                                <div style="font-size: 24px; margin-bottom: 5px;">✓</div>
                                <div style="font-weight: 600;">Pilihan Ganda</div>
                            </div>
                            <div class="type-option" onclick="selectType('isian', 'add')">
                                <div style="font-size: 24px; margin-bottom: 5px;">✍️</div>
                                <div style="font-weight: 600;">Isian</div>
                            </div>
                        </div>
                        <input type="hidden" name="tipe" id="addTipe" value="pg" required>
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold">Pertanyaan</label>
                        <textarea name="pertanyaan" class="form-control" rows="3" required></textarea>
                    </div>

                    <div id="addPGOptions">
                        <div class="form-section">
                            <label class="fw-semibold mb-2">Opsi Jawaban</label>

                            <div class="mb-2">
                                <label>A.</label>
                                <input type="text" name="opsi_a" class="form-control">
                            </div>
                            <div class="mb-2">
                                <label>B.</label>
                                <input type="text" name="opsi_b" class="form-control">
                            </div>
                            <div class="mb-2">
                                <label>C.</label>
                                <input type="text" name="opsi_c" class="form-control">
                            </div>
                            <div class="mb-2">
                                <label>D.</label>
                                <input type="text" name="opsi_d" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="fw-semibold">Jawaban Benar</label>
                            <select name="jawaban_benar" class="form-select">
                                <option value="">-- Pilih --</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-success" type="submit">Simpan Soal</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content" style="border-radius: 16px;">
                <div class="modal-header" style="background: linear-gradient(135deg, #f8e6cc, #ffe8c2);">
                    <h5 class="modal-title fw-bold" style="color: #4b2e14;">✏️ Edit Soal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="editContent">
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

<script>
function selectType(type, context) {
    const modal = context === 'add' ? document.getElementById('addModal') : document.getElementById('editModal');
    const options = modal.querySelectorAll('.type-option');

    options.forEach(opt => opt.classList.remove('active'));
    event.target.closest('.type-option').classList.add('active');

    document.getElementById(`${context}Tipe`).value = type;

    const pgOptions = document.getElementById(`${context}PGOptions`);

    if (type === 'pg') {
        pgOptions.style.display = 'block';
        pgOptions.querySelectorAll('input[name^="opsi_"]').forEach(el => el.required = true);
        pgOptions.querySelector('select[name="jawaban_benar"]').required = true;
    } else {
        pgOptions.style.display = 'none';
        pgOptions.querySelectorAll('input[name^="opsi_"]').forEach(el => {
            el.required = false;
            el.value = '';
        });
        pgOptions.querySelector('select[name="jawaban_benar"]').required = false;
        pgOptions.querySelector('select[name="jawaban_benar"]').value = '';
    }
}

function openEditModal(id) {
    fetch(`/admin/quiz/${id}/json`)
        .then(res => res.json())
        .then(data => {
            document.getElementById('editForm').action = `/admin/quiz/${id}`;

            let optionsHTML = '';
            if (data.tipe === 'pg') {
                optionsHTML = `
                    <div class="form-section">
                        <label class="fw-semibold mb-2">Opsi Jawaban</label>
                        <div class="mb-2">
                            <label>A.</label>
                            <input type="text" name="opsi_a" class="form-control" value="${data.opsi_a || ''}" required>
                        </div>
                        <div class="mb-2">
                            <label>B.</label>
                            <input type="text" name="opsi_b" class="form-control" value="${data.opsi_b || ''}" required>
                        </div>
                        <div class="mb-2">
                            <label>C.</label>
                            <input type="text" name="opsi_c" class="form-control" value="${data.opsi_c || ''}" required>
                        </div>
                        <div class="mb-2">
                            <label>D.</label>
                            <input type="text" name="opsi_d" class="form-control" value="${data.opsi_d || ''}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="fw-semibold">Jawaban Benar</label>
                        <select name="jawaban_benar" class="form-select" required>
                            <option value="">-- Pilih --</option>
                            <option value="A" ${data.jawaban_benar === 'A' ? 'selected' : ''}>A</option>
                            <option value="B" ${data.jawaban_benar === 'B' ? 'selected' : ''}>B</option>
                            <option value="C" ${data.jawaban_benar === 'C' ? 'selected' : ''}>C</option>
                            <option value="D" ${data.jawaban_benar === 'D' ? 'selected' : ''}>D</option>
                        </select>
                    </div>
                `;
            }

            document.getElementById('editContent').innerHTML = `
                <div class="mb-3">
                    <label class="fw-semibold mb-2">Tipe Soal</label>
                    <div class="type-selector">
                        <div class="type-option ${data.tipe === 'pg' ? 'active' : ''}" onclick="selectType('pg', 'edit')">
                            <div style="font-size: 24px; margin-bottom: 5px;">✓</div>
                            <div style="font-weight: 600;">Pilihan Ganda</div>
                        </div>
                        <div class="type-option ${data.tipe === 'isian' ? 'active' : ''}" onclick="selectType('isian', 'edit')">
                            <div style="font-size: 24px; margin-bottom: 5px;">✍️</div>
                            <div style="font-weight: 600;">Isian</div>
                        </div>
                    </div>
                    <input type="hidden" name="tipe" id="editTipe" value="${data.tipe}" required>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold">Pertanyaan</label>
                    <textarea name="pertanyaan" class="form-control" rows="3" required>${data.pertanyaan}</textarea>
                </div>

                <div id="editPGOptions" style="display: ${data.tipe === 'pg' ? 'block' : 'none'}">
                    ${optionsHTML}
                </div>
            `;

            new bootstrap.Modal(document.getElementById('editModal')).show();
        })
        .catch(err => {
            alert('Gagal memuat data soal');
            console.error(err);
        });
}
</script>

@endsection
