@extends('layouts.main')

 {{-- untuk styles khusus halaman tertentu --}}
 @section('this-page-style')
 @endsection

 @section('content')
     <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
         <div
             class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
             <h1 class="h2">User</h1>
             <div class="btn-toolbar mb-2 mb-md-0">
                 <!-- Tombol Tambah menggunakan tag a -->
                 <a href="{{ route('master.data.user.create') }}" class="btn btn-primary" role="button">Tambah</a>
             </div>
         </div>
         <div class="container mt-4">
             <!-- Tampilkan pesan sukses jika ada -->
             @if (session('success'))
                 <div class="alert alert-success">
                     {{ session('success') }}
                 </div>
             @endif
             <!-- Tabel Daftar User -->
             <table class="table table-striped">
                 <thead>
                     <tr>
                         <th scope="col">Aksi</th>
                         <th scope="col">Nama</th>
                         <th scope="col">Email</th>
                         <th scope="col">Role</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($users as $user)
                         <tr>
                             <td>
                                 <!-- Tombol Edit -->
                                 <a href="{{ route('master.data.user.edit', $user->id) }}"
                                     class="btn btn-sm btn-outline-secondary">
                                     Edit
                                 </a>
                                 <!-- Tombol Hapus -->
                                 <form action="{{ route('master.data.user.destroy', $user->id) }}" method="POST"
                                     style="display:inline;">
                                     @csrf
                                     @method('DELETE')
                                     <button type="submit" class="btn btn-sm btn-outline-danger"
                                         onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                         Hapus
                                     </button>
                                 </form>
                             </td>
                             <td>{{ $user->name }}</td>
                             <td>{{ $user->email }}</td>
                             <td>
                                 @if ($user->role == 'super_admin')
                                     <span class="badge bg-danger">Super Admin</span>
                                 @elseif ($user->role == 'admin')
                                     <span class="badge bg-success">Admin</span>
                                 @else
                                     <span class="badge bg-primary">Pengguna</span>
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
