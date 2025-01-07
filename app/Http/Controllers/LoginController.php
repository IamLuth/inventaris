<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle login requests.
     *
     * @param  \Illuminate\Http\Request  $req
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $req)
    {
        // Validasi input
        $req->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus terdiri dari minimal 6 karakter.',
        ]);

        // Ambil data input untuk login
        $credentials = $req->only('username', 'password');

        // Coba autentikasi
        if (Auth::attempt($credentials)) {
            // Jika berhasil login, periksa peran pengguna
            $role = Auth::user()->role;
            if ($role === 'admin') {
                return redirect('/admin')->with('success', 'Selamat datang, Admin!');
            } elseif ($role === 'kasir') {
                return redirect('/kasir')->with('success', 'Selamat datang, Kasir!');
            } else {
                Auth::logout();
                return redirect('/')->with('error', 'Peran pengguna tidak valid.');
            }
        }

        // Jika autentikasi gagal, kembali ke halaman login
        return redirect('/')
            ->with('error', 'Username atau password salah. Silakan coba lagi.');
    }
}
