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

