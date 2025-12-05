<!DOCTYPE html>
<html>
<head>
    <title>Login - PawPac</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f8e6cc, #ffe8c2);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(196, 138, 85, 0.2), transparent);
            border-radius: 50%;
        }

        body::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(161, 108, 62, 0.2), transparent);
            border-radius: 50%;
        }

        .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 20px;
            z-index: 1;
        }

        .brand-logo {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #c48a55, #a16c3e);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .brand-logo svg {
            width: 36px;
            height: 36px;
            fill: white;
        }

        .brand-text {
            font-size: 36px;
            font-weight: 700;
            color: #4b2e14;
            text-shadow: 1px 1px 2px rgba(255,255,255,0.5);
        }

        h1 {
            color: #4b2e14;
            text-align: center;
            margin-bottom: 30px;
            font-size: 32px;
            font-weight: 700;
            z-index: 1;
        }

        form {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            width: 380px;
            text-align: left;
            z-index: 1;
            border: 1px solid rgba(196, 138, 85, 0.1);
        }

        label {
            font-weight: 600;
            color: #4b2e14;
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .input-wrapper {
            position: relative;
            width: 100%;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 12px 40px 12px 12px;
            border-radius: 10px;
            border: 2px solid #e0c9a6;
            box-sizing: border-box;
            font-size: 15px;
            transition: all 0.3s ease;
            background-color: #fffaf2;
        }

        input:focus {
            outline: none;
            border-color: #c48a55;
            box-shadow: 0 0 0 3px rgba(196, 138, 85, 0.1);
            background-color: white;
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
            transition: color 0.3s ease;
        }

        .toggle-password:hover {
            color: #c48a55;
        }

        button {
            background: linear-gradient(135deg, #c48a55, #a16c3e);
            color: white;
            border: none;
            padding: 14px 20px;
            border-radius: 10px;
            cursor: pointer;
            width: 100%;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            margin-top: 10px;
            box-shadow: 0 4px 12px rgba(196, 138, 85, 0.3);
        }

        button:hover {
            background: linear-gradient(135deg, #a16c3e, #8b5e34);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(196, 138, 85, 0.4);
        }

        button:active {
            transform: translateY(0);
        }

        p {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #6b5030;
            z-index: 1;
        }

        a {
            color: #c48a55;
            text-decoration: none;
            font-weight: 600;
        }

        a:hover {
            text-decoration: underline;
            color: #a16c3e;
        }

        .message {
            text-align: center;
            margin-bottom: 20px;
            padding: 12px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
        }

        .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        @media (max-width: 480px) {
            form {
                width: 90%;
                padding: 30px 25px;
            }

            .brand-text {
                font-size: 28px;
            }

            h1 {
                font-size: 26px;
            }
        }
    </style>
</head>
<body>
    <div class="logo-container">
        <div class="brand-logo">
            <img src="{{ asset('storage/images/kucing/Logo.png') }}" alt="Logo" style="width: 50px;">
        </div>
        <div class="brand-text">PawPac</div>
    </div>

    <h1>Selamat Datang Kembali</h1>

    @if(session('success'))
        <div class="message success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="message error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label>Email</label>
        <div class="input-wrapper">
            <input type="email" name="email" required placeholder="Masukkan email Anda">
        </div>

        <label>Password</label>
        <div class="input-wrapper">
            <input type="password" name="password" id="password" required placeholder="Masukkan password">
            <span class="toggle-password" onclick="togglePassword('password')">
                <i class="fa-solid fa-eye"></i>
            </span>
        </div>
        @error('password')
            <div style="color:#e74c3c; font-size:13px; margin-top:-15px; margin-bottom:15px;">{{ $message }}</div>
        @enderror

        <button type="submit">
            <i class="fa-solid fa-right-to-bracket"></i> Masuk
        </button>
    </form>

    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a></p>

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
