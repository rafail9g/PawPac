@extends('layoutadopter')

@section('title', 'Edit Profil')

@section('content')
<style>
.profile-container {
    max-width: 800px;
    margin: 0 auto;
}

.profile-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 40px;
    border-radius: 16px;
    margin-bottom: 30px;
    text-align: center;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.profile-avatar {
    width: 120px;
    height: 120px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 48px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

.profile-name {
    font-size: 32px;
    font-weight: bold;
    margin-bottom: 5px;
}

.profile-role {
    font-size: 16px;
    opacity: 0.9;
}

.profile-card {
    background: white;
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

.section-title {
    font-size: 20px;
    font-weight: bold;
    color: #4b2e14;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 3px solid #c48a55;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    font-weight: 600;
    color: #4b2e14;
    margin-bottom: 8px;
    display: block;
}

.form-control {
    width: 100%;
    padding: 12px;
    border: 2px solid #e0c9a6;
    border-radius: 10px;
    font-size: 15px;
    transition: all 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: #c48a55;
    box-shadow: 0 0 0 3px rgba(196, 138, 85, 0.1);
}

.btn-save {
    background: linear-gradient(135deg, #c48a55, #a16c3e);
    color: white;
    border: none;
    padding: 14px 40px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 16px;
    transition: all 0.3s ease;
    cursor: pointer;
    width: 100%;
}

.btn-save:hover {
    background: linear-gradient(135deg, #a16c3e, #8b5e34);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(196, 138, 85, 0.3);
}

.input-wrapper {
    position: relative;
}

.toggle-password {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    font-size: 18px;
    color: #8b6f4e;
    z-index: 10;
}

.toggle-password:hover {
    color: #6b5030;
}

.password-hint {
    font-size: 13px;
    color: #6b5030;
    margin-top: 5px;
}

.alert {
    padding: 15px 20px;
    border-radius: 10px;
    margin-bottom: 20px;
}

.alert-success {
    background: #d4edda;
    border: 2px solid #c3e6cb;
    color: #155724;
}

.alert-danger {
    background: #f8d7da;
    border: 2px solid #f5c6cb;
    color: #721c24;
}

.info-box {
    background: linear-gradient(135deg, #f8e6cc, #ffe8c2);
    padding: 15px 20px;
    border-radius: 10px;
    margin-bottom: 20px;
    color: #4b2e14;
}

.info-box i {
    margin-right: 10px;
    color: #c48a55;
}
</style>

<div class="profile-container">

    <div class="profile-header">
        <div class="profile-avatar">
            👤
        </div>
        <div class="profile-name">{{ $user->name }}</div>
        <div class="profile-role">Adopter</div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <strong>✓ Berhasil!</strong> {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>✗ Terjadi Kesalahan:</strong>
            <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="info-box">
        <i class="bi bi-info-circle"></i>
        <strong>Info:</strong> Update informasi profil Anda di sini. Pastikan data yang Anda masukkan akurat.
    </div>

    <form method="POST" action="{{ route('adopter.profile.update') }}">
        @csrf
        @method('PUT')

        <div class="profile-card">
            <h3 class="section-title">Informasi Pribadi</h3>

            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ old('name', $user->name) }}"
                       required>
            </div>

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email"
                       name="email"
                       class="form-control"
                       value="{{ old('email', $user->email) }}"
                       required>
            </div>

            <div class="form-group">
                <label class="form-label">Nomor Telepon</label>
                <input type="text"
                       name="phone"
                       class="form-control"
                       value="{{ old('phone', $user->phone) }}"
                       placeholder="Contoh: 08123456789">
            </div>

            <div class="form-group">
                <label class="form-label">Alamat Lengkap</label>
                <textarea name="address"
                          class="form-control"
                          rows="3"
                          placeholder="Masukkan alamat lengkap Anda">{{ old('address', $user->address) }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Lingkungan Tempat Tinggal</label>
                <textarea name="living_environment"
                          class="form-control"
                          rows="3"
                          placeholder="Deskripsikan lingkungan tempat tinggal Anda (Contoh: Rumah dengan halaman luas, Apartemen, Kost, dll)">{{ old('living_environment', $user->living_environment) }}</textarea>
            </div>
        </div>

        <div class="profile-card">
            <h3 class="section-title">Ubah Password (Opsional)</h3>

            <div class="info-box">
                <i class="bi bi-shield-lock"></i>
                Kosongkan jika tidak ingin mengubah password
            </div>

            <div class="form-group">
                <label class="form-label">Password Saat Ini</label>
                <div class="input-wrapper">
                    <input type="password"
                           name="current_password"
                           id="current_password"
                           class="form-control"
                           placeholder="Masukkan password lama">
                    <span class="toggle-password" onclick="togglePassword('current_password')">
                        <i class="fa-solid fa-eye"></i>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Password Baru</label>
                <div class="input-wrapper">
                    <input type="password"
                           name="new_password"
                           id="new_password"
                           class="form-control"
                           placeholder="Minimal 6 karakter">
                    <span class="toggle-password" onclick="togglePassword('new_password')">
                        <i class="fa-solid fa-eye"></i>
                    </span>
                </div>
                <div class="password-hint">Minimal 6 karakter</div>
            </div>

            <div class="form-group">
                <label class="form-label">Konfirmasi Password Baru</label>
                <div class="input-wrapper">
                    <input type="password"
                           name="new_password_confirmation"
                           id="new_password_confirmation"
                           class="form-control"
                           placeholder="Ulangi password baru">
                    <span class="toggle-password" onclick="togglePassword('new_password_confirmation')">
                        <i class="fa-solid fa-eye"></i>
                    </span>
                </div>
            </div>
        </div>

        <button type="submit" class="btn-save">
            Simpan Perubahan
        </button>

    </form>

</div>

<script>
function togglePassword(id) {
    const input = document.getElementById(id);
    const icon = input.nextElementSibling.querySelector('i');

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = "password";
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>
@endsection
