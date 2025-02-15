@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <h1>{{ $buku->judul }}</h1>
        <p><strong>Penulis:</strong> {{ $buku->penulis }}</p>
        <p><strong>Deskripsi:</strong> {{ $buku->deskripsi }}</p>
        <p><strong>Status:</strong> {{ $buku->status }}</p>

        <!-- Tombol Edit Buku -->
        <a href="{{ route('master.data.buku.edit', $buku->id_buku) }}" class="btn btn-primary">Edit Buku</a>
    </div>
@endsection
