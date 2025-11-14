<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengguna;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect('/admin');
            } elseif (Auth::user()->role === 'adopter') {
                return redirect('/adopter');
            } elseif (Auth::user()->role === 'provider') {
                return redirect('/provider');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ]);
    }

    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:pengguna,email',
            'password' => 'required|min:6|confirmed',
        ]);

        Pengguna::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'adopter',
            'address' => $request->address,
            'phone' => $request->phone,
            'living_environment' => $request->living_environment,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

// <?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use App\Models\User;

// class AuthController extends Controller
// {
//     public function showLoginForm()
//     {
//         return view('auth.login');
//     }

//     public function login(Request $request)
//     {
//         $credentials = $request->validate([
//             'email' => 'required|email',
//             'password' => 'required',
//         ], [
//             'email.required' => 'Email wajib diisi.',
//             'email.email' => 'Format email tidak valid.',
//             'password.required' => 'Password wajib diisi.',
//         ]);

//         if (Auth::attempt($credentials)) {
//             $request->session()->regenerate();

//             if (Auth::user()->role === 'admin') {
//                 return redirect()->route('dashboard');
//             } else {
//                 return redirect()->route('pengunjung');
//             }
//         }
//         return back()->with('error', 'Email atau password salah.');
//     }


//     public function showRegisterForm()
//     {
//         return view('auth.register');
//     }

//     public function register(Request $request)
//     {
//         $data = $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|email|unique:users,email',
//             'password' => 'required|min:6|confirmed',
//         ], [
//             'name.required' => 'Nama wajib diisi.',
//             'email.required' => 'Email wajib diisi.',
//             'password.required' => 'Password wajib diisi.',
//             'password.min' => 'Password minimal 6 karakter.',
//             'password.confirmed' => 'Konfirmasi password tidak cocok.',
//         ]);

//         $data['password'] = bcrypt($data['password']);
//         $data['role'] = 'adopter';
//         User::create($data);
//         return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
//     }

//     public function logout(Request $request)
//     {
//         Auth::logout();
//         $request->session()->invalidate();
//         $request->session()->regenerateToken();
//         return redirect('/');
//     }
// }
