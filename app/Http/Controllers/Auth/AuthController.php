<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
        /**
     * Menampilkan form login.
     */
    public function loginForm()
        {
            return view('auth.loginForm');
        }

    /**
 * Menangani proses login.
 */
    public function login(Request $request)
    {
        // Ambil email dan password dari request
        $credential = $request->only('email', 'password');

        // Validasi input
        $validated = Validator::make($credential, [
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Jika validasi gagal, redirect kembali dengan error
        if ($validated->fails()) {
            return redirect()->back()->withErrors($validated)->withInput();
        }

        // Jika login berhasil, regenerasi session dan redirect
        if (Auth::attempt($credential)) {
            // Buat ulang sesi untuk mencegah serangan fiksasi sesi
            $request->session()->regenerate();

            // Mengarahkan pengguna ke halaman atau beranda yang dituju
            return redirect()->intended('/');
        }

        // Jika login gagal, kembali dengan pesan error
        return redirect()->back()->with('error', 'Login Gagal. Email atau Password salah');
    }

    /**
 * Menangani logout dan invalidasi session.
 */
    public function logout(Request $request)
    {
        // Logout, invalidate session, dan regenerate token
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login
        return redirect()->route('login');
    }

    //menampilkan halaman unauthorized
    public function unauthorized()
    {
        return view('auth.403');
    }

}
