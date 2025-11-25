<!DOCTYPE html>
<html>
<head>
    <title>Registrasi CatAdopt</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fff4e2, #ffe7c1);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        h1 {
            color: #4b2e14;
            text-shadow: 1px 1px #fff;
            margin-bottom: 20px;
        }
        form {
            background-color: #fffaf2;
            padding: 30px 40px;
            border-radius: 16px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            width: 340px;
            text-align: left;
        }
        label {
            font-weight: bold;
            color: #4b2e14;
            display: block;
            margin-bottom: 5px;
        }
        input {
            width: 100%;
            padding: 8px 40px 8px 8px; /* padding kanan untuk ikon */
            border-radius: 8px;
            border: 1px solid #cfa97e;
            box-sizing: border-box;
        }
        input:focus {
            outline: none;
            border-color: #b57943;
            box-shadow: 0 0 4px #b57943;
        }
        button {
            background-color: #c48a55;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            font-weight: bold;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }
        button:hover {
            background-color: #ad7340;
        }
        p {
            margin-top: 12px;
            text-align: center;
            font-size: 14px;
        }
        a {
            color: #8b5e34;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .message {
            text-align: center;
            margin-bottom: 10px;
            font-size: 14px;
        }
        .header-box {
            background-color: #f8e6cc;
            padding: 8px 20px;
            border-radius: 12px;
            margin-bottom: 10px;
            color: #4b2e14;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .input-wrapper {
            position: relative;
            width: 100%;
            margin-bottom: 15px;
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
    </style>
</head>
<body>
    <div class="header-box">PawPac</div>
    <h1>Registrasi</h1>

    <form method="POST" action="/register">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <label>Nama Lengkap:</label>
        <input type="text" name="name" required value="{{ old('name') }}">
        @error('name')
            <div style="color:red; font-size:12px; margin-top:-10px; margin-bottom:10px;">{{ $message }}</div>
        @enderror

        <label>Email:</label>
        <input type="email" name="email" required value="{{ old('email') }}">
        @error('email')
            <div style="color:red; font-size:12px; margin-top:-10px; margin-bottom:10px;">{{ $message }}</div>
        @enderror

        <label>Password:</label>
        <div class="input-wrapper">
            <input type="password" name="password" id="password" required placeholder="Minimal 6 karakter">
            <span class="toggle-password" onclick="togglePassword('password')">
                <i class="fa-solid fa-eye"></i>
            </span>
        </div>
        @error('password')
            <div style="color:red; font-size:12px; margin-top:-10px; margin-bottom:10px;">{{ $message }}</div>
        @enderror

        <label>Konfirmasi Password:</label>
        <div class="input-wrapper">
            <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Ulangi password">
            <span class="toggle-password" onclick="togglePassword('password_confirmation')">
                <i class="fa-solid fa-eye"></i>
            </span>
        </div>
        @error('password_confirmation')
            <div style="color:red; font-size:12px; margin-top:-10px; margin-bottom:10px;">{{ $message }}</div>
        @enderror

        <button type="submit">Daftar</button>
    </form>

    <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>

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
</body>
</html>