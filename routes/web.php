<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProfilController;

// Route untuk autentikasi
Route::get('login', [AuthController::class, 'loginForm'])->name('login.form');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('unauthorized', [AuthController::class, 'unauthorized'])->name('unauthorized');

// Route untuk profil (terpisah dari master-data)
Route::middleware(['auth'])->prefix('profil')->name('profil.')->group(function () {
    Route::get('/', [ProfilController::class, 'index'])->name('index');
    Route::put('/{user}', [ProfilController::class, 'update'])->name('update');
});

// Route untuk dashboard (dengan middleware auth)
Route::get('/', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard.index');

// Group route dengan prefix dan middleware auth
Route::middleware(['auth'])->prefix('master-data')->name('master.data.')->group(function () {
    // Route resource kategori hanya untuk super_admin
    Route::resource('kategori', KategoriController::class)->middleware(['role:super_admin']);

    // Group route buku untuk super_admin dan admin
    Route::middleware(['role:super_admin,admin'])->prefix('buku')->name('buku.')->group(function () {
        Route::get('/', [BukuController::class, 'index'])->name('index');
        Route::get('/create', [BukuController::class, 'create'])->name('create');
        Route::post('/', [BukuController::class, 'store'])->name('store');
        Route::get('/{buku}/edit', [BukuController::class, 'edit'])->name('edit');
        Route::put('/{buku}', [BukuController::class, 'update'])->name('update');
        Route::delete('/{buku}', [BukuController::class, 'destroy'])->name('destroy');
    });

    // Group route user hanya untuk super_admin
    Route::middleware(['role:super_admin'])->prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    });

});
