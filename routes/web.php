<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

// Halaman Register & Login
Route::get('/register', [AuthController::class, 'registerPage'])->name('register.page');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'loginPage'])->name('login.page');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Logout (Hanya untuk user yang sudah login)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Lupa Password
Route::get('/forgot-password', [AuthController::class, 'forgotPasswordPage'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');

// Reset Password
Route::get('/reset-password/{token}', [AuthController::class, 'resetPasswordPage'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

// Data Barang ===================================================== //
Route::get('/admin/data-barang', function () {
    return view('admin.data-barang.index');
});
Route::get('/admin/tambah-data-barang', function () {
    return view('admin.data-barang.create');
});
Route::get('/admin/edit-data-barang', function () {
    return view('admin.data-barang.edit');
});

// data sewa ===================================================== //
Route::get('/admin/data-sewa', function () {
    return view('admin.data-sewa.index');
});


// kelola user ===================================================== //
Route::get('/admin/kelola-user', function () {
    return view('admin.kelola-user.index');
});
Route::get('/admin/tambah-user', function () {
    return view('admin.kelola-user.create');
});


// kelola-diskon ===================================================== //
Route::get('/admin/kelola-diskon', function () {
    return view('admin.diskon.index');
});
Route::get('/admin/tambah-diskon', function () {
    return view('admin.diskon.create');
});
Route::get('/admin/edit-diskon', function () {
    return view('admin.diskon.edit');
});

// Laporan Admin ===================================================== //
Route::get('/admin/laporan-goodrent', function () {
    return view('admin.laporan.index');
});



// ======================= U S E R ========================= //
Route::get('/goodrent/produk', function () {
    return view('user.index');
})->name('user.dashboard');

Route::get('/goodrent/lihat-produk/', function () {
    return view('user.detail-produk');
});
Route::get('/profile', function () {
    return view('user.profile');
})->name('user.index');