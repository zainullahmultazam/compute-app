@extends('layouts.main')

 {{-- untuk styles khusus halaman tertentu --}}
 @section('this-page-style')

 @section('content')
     <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
         <div
             class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
             <h1 class="h2">Kategori</h1>
             <div class="btn-toolbar mb-2 mb-md-0">
                 <!-- Tombol Tambah menggunakan tag a -->
                 <a href="{{ route('master.data.kategori.create') }}" class="btn btn-primary" role="button">Tambah</a>
             </div>
         </div>
         <div class="container mt-4">
            <!-- Pesan Sukses -->
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show shadow-lg p-4 rounded d-flex align-items-center position-relative" role="alert" style="background: linear-gradient(135deg, #ce38ec, #3c2bd8); color: #fff; border: none; animation: slideIn 0.8s;">
    <i class="bi bi-emoji-heart-eyes-fill me-3" style="font-size: 2rem; animation: bounce 1s infinite;"></i>
    <div>
        <h5 class="mb-1 fw-bold" style="text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">Berhasil!</h5>
        <p class="mb-0">{{ session('success') }}</p>
    </div>
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close" style="background: none; border: none; color: #fff; font-size: 1.2rem;"></button>
    <div class="position-absolute end-0 top-0 pe-3 pt-2" style="opacity: 0.8; font-size: 4rem; color: rgba(255, 255, 255, 0.1);">
        🎉
    </div>
</div>
@endif

<!-- Pesan Error -->
@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show shadow-lg p-4 rounded d-flex align-items-center position-relative" role="alert" style="background: linear-gradient(135deg, #f44336, #e57373); color: #fff; border: none; animation: shake 0.6s;">
    <i class="bi bi-emoji-angry-fill me-3" style="font-size: 2rem; animation: pulse 1.5s infinite;"></i>
    <div>
        <h5 class="mb-1 fw-bold" style="text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">Oops, Terjadi Kesalahan!</h5>
        <p class="mb-0">{{ session('error') }}</p>
    </div>
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close" style="background: none; border: none; color: #fff; font-size: 1.2rem;"></button>
    <div class="position-absolute end-0 top-0 pe-3 pt-2" style="opacity: 0.8; font-size: 4rem; color: rgba(255, 255, 255, 0.1);">
        ⚠️
    </div>
</div>
@endif

<style>
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    @keyframes shake {
        0%, 100% {
            transform: translateX(0);
        }
        20%, 60% {
            transform: translateX(-10px);
        }
        40%, 80% {
            transform: translateX(10px);
        }
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(1.2);
            opacity: 0.8;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }
</style>
             <!-- Tabel Daftar Kategori -->
             <table class="table table-striped">
                 <thead>
                     <tr>
                         <th scope="col">Aksi</th>
                         <th scope="col">Kategori</th>
                         <th scope="col">Keterangan</th>
                         <th scope="col">Status</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($kategoris as $kategori)
                         <tr>
                             <td>
                                 <!-- Tombol Edit -->
                                 <a href="{{ route('master.data.kategori.edit', $kategori->id_kategori) }}"
                                     class="btn btn-sm btn-outline-secondary">
                                     Edit
                                 </a>
                                 <!-- Tombol Hapus -->
                                 <form action="{{ route('master.data.kategori.destroy', $kategori->id_kategori) }}"
                                     method="POST" style="display:inline;">
                                     @csrf
                                     @method('DELETE')
                                     <button type="submit" class="btn btn-sm btn-outline-danger"
                                         onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                         Hapus
                                     </button>
                                 </form>
                             </td>
                             <td>{{ $kategori->nama }}</td>
                             <td>{{ $kategori->keterangan ?? 'Tidak ada keterangan' }}</td>
                             <td>
                                 @if ($kategori->status == 'aktif')
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