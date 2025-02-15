<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Buku;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = Kategori::all(); // Mengambil semua data kategori
        return view('kategori.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dengan pesan kustom
    $validated = $request->validate([
        'nama' => 'required|string|max:255|unique:kategoris',
        'keterangan' => 'nullable|string|max:255',
        'status' => 'required|in:aktif,nonaktif',
    ], [
        // Pesan kustom untuk field 'nama'
        'nama.required' => 'Nama kategori wajib diisi.',
        'nama.string' => 'Nama kategori harus berupa teks.',
        'nama.max' => 'Nama kategori tidak boleh lebih dari 255 karakter.',
        'nama.unique' => 'Nama kategori sudah terdaftar. Silakan gunakan nama lain.',

        // Pesan kustom untuk field 'keterangan'
        'keterangan.string' => 'Keterangan harus berupa teks.',
        'keterangan.max' => 'Keterangan tidak boleh lebih dari 255 karakter.',

        // Pesan kustom untuk field 'status'
        'status.required' => 'Status kategori wajib dipilih.',
        'status.in' => 'Status kategori yang dipilih tidak valid.',
    ]);

    // Simpan data kategori baru ke database
    Kategori::create($validated);

    // Redirect ke halaman index dengan pesan sukses
    return redirect()
        ->route('master.data.kategori.index')
        ->with('success', 'Kategori berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input dengan pesan kustom
    $validated = $request->validate([
        'nama' => 'required|string|max:255|unique:kategoris,nama,' . $id . ',id_kategori',
        'keterangan' => 'nullable|string|max:255',
        'status' => 'required|in:aktif,nonaktif',
    ], [
        // Pesan kustom untuk field 'nama'
        'nama.required' => 'Nama kategori wajib diisi.',
        'nama.string' => 'Nama kategori harus berupa teks.',
        'nama.max' => 'Nama kategori tidak boleh lebih dari 255 karakter.',
        'nama.unique' => 'Nama kategori sudah terdaftar. Silakan gunakan nama lain.',

        // Pesan kustom untuk field 'keterangan'
        'keterangan.string' => 'Keterangan harus berupa teks.',
        'keterangan.max' => 'Keterangan tidak boleh lebih dari 255 karakter.',

        // Pesan kustom untuk field 'status'
        'status.required' => 'Status kategori wajib dipilih.',
        'status.in' => 'Status kategori yang dipilih tidak valid.',
    ]);

    // Cari kategori berdasarkan ID
    $kategori = Kategori::findOrFail($id);

    // Update kategori dengan data baru
    $kategori->update($validated);

    // Redirect ke halaman index dengan pesan sukses
    return redirect()
        ->route('master.data.kategori.index')
        ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari kategori berdasarkan ID
    $kategori = Kategori::findOrFail($id);

    // Cek apakah kategori memiliki relasi dengan buku
    if ($kategori->buku()->count() > 0) {
        // Jika ada buku yng terhitung dengan kategori ini, kembalikan pesan eror
        return redirect()->route('master.data.kategori.index')
        ->with('eror', 'Kategori ini tidak bisa dihapus karena memiliki relasi dengan buku.');
    }

    // Hapus kategori
    $kategori->delete();

    // Redirect ke halaman index dengan pesan sukses
    return redirect()
        ->route('master.data.kategori.index')
        ->with('success', 'Kategori berhasil dihapus.');
    }


}
