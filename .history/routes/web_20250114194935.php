<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;

// Halaman login
Route::get('/', function () {
    return view('login');
})->name('login');

// Proses login
Route::post('/login', [LoginController::class, 'login'])->name('login.process');

// Rute admin dengan middleware auth
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'admin'])->name('admin.dashboard');
});

Route::get('/admin/barang', [AdminController::class, 'barang']); //ini untuk menampilkan data
Route::get('/admin/barang/tambah', [AdminController::class, 'tambah_barang']); //ini untuk menampilkan form tambah
Route::get('/admin/barang/edit/{id}', [AdminController::class, 'edit_barang']); //ini untuk menampilkan form edit
Route::get('/admin/barang/delete/{id}', [AdminController::class, 'delete_barang']); //ini untuk menghapus data
Route::post('/admin/barang/simpan', [AdminController::class, 'simpan_barang']); //ini untuk menyimpan data
Route::post('/admin/barang/update/{id}', [AdminController::class, 'update_barang']); //ini untuk mengupdate data

Route::get('/kasir', function () {
    return view('layouts.master');});
