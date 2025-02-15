<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->id('id_buku'); // Kolom id untuk buku
            $table->unsignedBigInteger('kategori_id'); // Kolom untuk kategori yang berelasi
            $table->string('judul'); // Judul buku
            $table->text('deskripsi'); // Deskripsi buku
            $table->string('penulis'); // Penulis buku
            $table->string('cover'); // Cover buku
            $table->enum('status', ['aktif', 'nonaktif']); // Status buku
            $table->timestamps(); // Timestamps untuk created_at dan updated_at

            // Menambahkan foreign key constraint pada kategori_id
            $table->foreign('kategori_id')->references('id_kategori')->on('kategoris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Menghapus tabel bukus jika rollback migrasi dilakukan
        Schema::dropIfExists('bukus');
    }
};
