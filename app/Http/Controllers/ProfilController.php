<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    /**
     * Display form profil
     */
    public function index()
    {
        return view('profil.index');
    }

    /**
     * Update profil pengguna.
     */
    public function update(Request $request, $id)
{
    // Validasi input dengan pesan kostum dalam bahasa indonesia
    $request->validate([
        'email' => 'required|email|unique:users,email,' . $id,
        'password_sekarang' => 'nullable|current_password', 
        'password_baru' => 'nullable|min:6|confirmed',
    ], [
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email sudah terdaftar.',
        'password_sekarang.required' => 'Password sekarang wajib diisi jika Anda ingin mengganti password.',
        'password_sekarang.current_password' => 'Password sekarang tidak cocok.',
        'password_baru.min' => 'Password baru harus memiliki minimal 6 karakter.',
        'password_baru.confirmed' => 'Konfirmasi password baru tidak cocok.',
    ]);

    // Ambil user yang sedang login
    $user = User::find($id);

    // Variabel untuk pesan sukses
    $successMessage = '';

    // Update email
if ($request->filled('email') && $request->email == $user->email) {
   $user->email = $request->email;
   $successMessage .= 'Email berhasil diperbaharui.';
}

// Jika password baru diisi, periksa password sekarang dan update password
if ($request->filled('password_baru')) {
    if (!$request->filled('password_sekarang')) {
        return back()
        ->withErrors(['password_sekarang' => 'Password sekarang harus diisi jika ingin mengganti password.']);
    }

    // Update password sekarang
    if (!Hash::check($request->password_sekarang, $user->password)) {
        return back()
        ->withErrors(['password_sekarang' => 'Password sekarang yang Anda masukkan salah.']);
    }

    // Update password baru
    $user->password = Hash::make($request->password_baru);

    // Tambahkan pesan perubahan password
    $successMessage .= 'Password berhasil diperbarui';
}

    // Simpan perubahan
    $user->save(); // Pastikan objek $user adalah instance dari User model

    //Redirect kembali dengan pesan sukses
    return redirect()->route('profil.index')
    ->with('success', $successMessage); // Menampilkan pesan sukses
}
}
