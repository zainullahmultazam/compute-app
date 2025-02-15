<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::with('kategori')->get();  // Ambil data buku beserta kategori
        return view('buku.index', compact('bukus'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('buku.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
    // Validasi input dengan pesan kustom
    $validated = $request->validate([
        'kategori_id' => 'required|exists:kategoris,id_kategori', // Validasi kategori_id
        'judul' => 'required|string|max:255|unique:bukus',
        'deskripsi' => 'required|string',
        'penulis' => 'required|string',
        'cover' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        'status' => 'required|in:aktif,nonaktif',
    ], [
        // Pesan kustom untuk kategori_id
        'kategori_id.required' => 'Kategori wajib dipilih.',
        'kategori_id.exists' => 'Kategori yang dipilih tidak valid.',

        // Pesan kustom untuk judul
        'judul.required' => 'Judul buku wajib diisi.',
        'judul.string' => 'Judul buku harus berupa teks.',
        'judul.max' => 'Judul buku tidak boleh lebih dari 255 karakter.',
        'judul.unique' => 'Judul buku sudah terdaftar. Silakan gunakan judul lain.',

        // Pesan kustom untuk deskripsi
        'deskripsi.required' => 'Deskripsi buku wajib diisi.',
        'deskripsi.string' => 'Deskripsi buku harus berupa teks.',

        // Pesan kustom untuk penulis
        'penulis.required' => 'Nama penulis wajib diisi.',
        'penulis.string' => 'Nama penulis harus berupa teks.',

        // Pesan kustom untuk cover
        'cover.required' => 'Cover buku wajib diunggah.',
        'cover.image' => 'File cover harus berupa gambar.',
        'cover.mimes' => 'Cover hanya boleh memiliki format jpg, jpeg, png, atau gif.',
        'cover.max' => 'Ukuran cover tidak boleh lebih dari 2 MB.',

        // Pesan kustom untuk status
        'status.required' => 'Status buku wajib dipilih.',
        'status.in' => 'Status buku yang dipilih tidak valid.',
    ]);

    // Proses upload file cover
    $coverName = null;
    if ($request->hasFile('cover')) {
        $file = $request->file('cover');
        $coverName = 'cover_' . now()->timestamp . '.' . $file->getClientOriginalExtension();
        $coverPath = public_path('images/covers');
        $file->move($coverPath, $coverName);
        $coverName = 'images/covers/' . $coverName;
    }

    // Simpan data buku ke database
    Buku::create([
        'kategori_id' => $validated['kategori_id'],
        'judul' => $validated['judul'],
        'deskripsi' => $validated['deskripsi'],
        'penulis' => $validated['penulis'],
        'cover' => $coverName,
        'status' => $validated['status'],
    ]);

    // Redirect ke halaman index dengan pesan sukses
    return redirect()
        ->route('master.data.buku.index')
        ->with('success', 'Buku berhasil ditambahkan.');
    }



    public function edit(string $id)
    {
        $buku = Buku::findOrFail($id);
        $kategoris = Kategori::all(); // Mengambil semua kategori

        return view('buku.edit', compact('buku', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input dengan pesan kustom
    $validated = $request->validate([
        'kategori_id' => 'required|exists:kategoris,id_kategori',
        'judul' => 'required|string|max:255|unique:bukus,judul,' . $id . ',id_buku',
        'deskripsi' => 'required|string',
        'penulis' => 'required|string',
        'cover' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        'status' => 'required|in:aktif,nonaktif',
    ], [
        // Pesan kustom untuk kategori_id
        'kategori_id.required' => 'Kategori wajib dipilih.',
        'kategori_id.exists' => 'Kategori yang dipilih tidak valid.',

        // Pesan kustom untuk judul
        'judul.required' => 'Judul buku wajib diisi.',
        'judul.string' => 'Judul buku harus berupa teks.',
        'judul.max' => 'Judul buku tidak boleh lebih dari 255 karakter.',
        'judul.unique' => 'Judul buku sudah terdaftar. Silakan gunakan judul lain.',

        // Pesan kustom untuk deskripsi
        'deskripsi.required' => 'Deskripsi buku wajib diisi.',
        'deskripsi.string' => 'Deskripsi buku harus berupa teks.',

        // Pesan kustom untuk penulis
        'penulis.required' => 'Nama penulis wajib diisi.',
        'penulis.string' => 'Nama penulis harus berupa teks.',

        // Pesan kustom untuk cover
        'cover.image' => 'File cover harus berupa gambar.',
        'cover.mimes' => 'Cover hanya boleh memiliki format jpg, jpeg, png, atau gif.',
        'cover.max' => 'Ukuran cover tidak boleh lebih dari 2 MB.',

        // Pesan kustom untuk status
        'status.required' => 'Status buku wajib dipilih.',
        'status.in' => 'Status buku yang dipilih tidak valid.',
    ]);

    // Cari buku berdasarkan ID
    $buku = Buku::findOrFail($id);

    // Proses upload file cover jika ada
    if ($request->hasFile('cover')) {
        // Hapus cover lama jika ada
        if ($buku->cover && file_exists(public_path($buku->cover))) {
            unlink(public_path($buku->cover));
        }

        // Upload cover baru
        $file = $request->file('cover');
        $coverName = 'cover_' . now()->timestamp . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images/covers'), $coverName);
        $validated['cover'] = 'images/covers/' . $coverName;
    }

    // Update data buku
    $buku->update($validated);

    // Redirect ke halaman index dengan pesan sukses
    return redirect()
        ->route('master.data.buku.index')
        ->with('success', 'Buku berhasil diperbarui.');
    }

    public function show($id_buku)
    {
        // Cari buku berdasarkan ID
        $buku = Buku::findOrFail($id_buku);

        // Kirim data buku ke view
        return view('buku.show', compact('buku'));
    }

    public function destroy(string $id)
    {
        $buku = Buku::findOrFail($id);

        if ($buku->cover && file_exists(public_path($buku->cover))) {
            unlink(public_path($buku->cover));
        }

        $buku->delete();

        return redirect()->route('master.data.buku.index')->with('success', 'Buku berhasil dihapus.');
    }

}