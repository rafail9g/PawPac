<!DOCTYPE html>
<html>
<head>
    <title>Registrasi CatAdopt</title>
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
        }
        input {
            width: 100%;
            padding: 8px;
            border-radius: 8px;
            border: 1px solid #cfa97e;
            margin-top: 5px;
            margin-bottom: 15px;
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
    </style>
</head>
<body>
    <div class="header-box">PawPac</div>
    <h1>Registrasi</h1>

    @if($errors->any())
        <div class="message" style="color:red;">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <label>Nama Lengkap:</label><br>
        <input type="text" name="name" required><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br>

        <label>Konfirmasi Password:</label><br>
        <input type="password" name="password_confirmation" required><br>

        <button type="submit">Daftar</button>
    </form>

    <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
</body>
</html>
