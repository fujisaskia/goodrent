<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});


// ==================== A D M I N ==================== //
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

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
});

Route::get('/goodrent/lihat-produk/', function () {
    return view('user.detail-produk');
});