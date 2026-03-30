<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        // Pastikan file view ada di resources/views/auth/index.blade.php
        return view('auth.index');
    }

    public function login(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Mencoba Login
        // Auth::attempt akan otomatis meng-hash password input dan mencocokkannya dengan di DB
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Menggunakan intended agar user dikembalikan ke halaman yang ingin dituju sebelumnya
            // atau default ke route 'home'
            return redirect()->intended(route('home'));
        }

        // 3. Jika gagal, kembali dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email'); // Mempertahankan input email agar user tidak perlu ngetik ulang
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
