<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    // Menentukan nama tabel
    protected $table = 'bukus'; // Pastikan nama tabel sesuai dengan yang ada di database

    // Menentukan kolom primary key yang digunakan (misalnya id_buku)
    protected $primaryKey = 'id_buku'; // Gantilah 'id_buku' dengan nama primary key yang digunakan

    // Menambahkan kolom yang bisa di-assign massal
    protected $fillable = [
        'kategori_id',  // Kolom relasi ke tabel Kategori
        'judul',        // Kolom untuk judul buku
        'deskripsi',    // Kolom untuk deskripsi buku
        'penulis',      // Kolom untuk penulis buku
        'cover',        // Kolom untuk gambar cover
        'status',       // Kolom status buku (aktif/nonaktif)
    ];

    // Relasi ke model Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id_kategori');
    }
}



