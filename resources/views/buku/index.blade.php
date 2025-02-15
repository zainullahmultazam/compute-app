@extends('layouts.main')

 {{-- untuk styles khusus halaman tertentu --}}
 @section('this-page-style')
 @endsection

 @section('content')
     <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
         <div
             class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
             <h1 class="h2">Buku</h1>
             <div class="btn-toolbar mb-2 mb-md-0">
                 <!-- Tombol Tambah menggunakan tag a -->
                 <a href="{{ route('master.data.buku.create') }}" class="btn btn-primary" role="button">Tambah</a>
             </div>
         </div>
         <div class="container mt-4">
             <!-- Tampilkan pesan sukses jika ada -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

             <!-- Tabel Daftar Buku -->
             <table class="table table-striped">
                 <thead>
                     <tr>
                         <th scope="col">Aksi</th>
                         <th scope="col">Judul</th>
                         <th scope="col">Kategori</th>
                         <th scope="col">Penulis</th>
                         <th scope="col">Status</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($bukus as $buku)
                         <tr>
                             <td>
                                 <!-- Tombol Edit -->
                                 <a href="{{ route('master.data.buku.edit', $buku->id_buku) }}"
                                     class="btn btn-sm btn-outline-secondary">
                                     Edit
                                 </a>
                                 <!-- Tombol Hapus -->
                                 <form action="{{ route('master.data.buku.destroy', $buku->id_buku) }}" method="POST"
                                     style="display:inline;">
                                     @csrf
                                     @method('DELETE')
                                     <button type="submit" class="btn btn-sm btn-outline-danger"
                                         onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                         Hapus
                                     </button>
                                 </form>
                             </td>
                             <td>{{ $buku->judul }}</td>
                             <td>{{ $buku->kategori->nama }}</td>
                             <td>{{ $buku->penulis }}</td>
                             <td>
                                 @if ($buku->status == 'aktif')
                                     <span class="badge bg-success">Aktif</span>
                                 @else
                                     <span class="badge bg-danger">Non-Aktif</span>
                                 @endif
                             </td>
                         </tr>
                     @endforeach
                 </tbody>
             </table>
         </div>
     </main>
 @endsection

 {{-- untuk scripts khusus halaman tertentu --}}
 @section('this-page-scripts')
 @endsection
