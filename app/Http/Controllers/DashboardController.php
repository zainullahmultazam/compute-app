<?php

namespace App\Http\Controllers;
use App\Models\Buku;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    // Ambil semua buku yang ada di database
    //$bukus = Buku::get();

    //$bukus = Buku::with('kategori')->where('status', 'aktif')->get();

    //$bukus = Buku::with('kategori')->where('status', 'aktif')->orderBy('created_at', 'DESC')->get();

    $bukus = Buku::with('kategori')
        ->where('status', 'aktif')
        ->orderBy('created_at', 'DESC')
        ->get()
        ->take(2);
    
    // Kirim data buku ke view dashboard
    return view('dashboard.indexx', compact('bukus'));

    // $query = Buku::get();

    // return $query;
}

}
