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

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/admin/data-barang', function () {
    return view('admin.data-barang.index');
});

Route::get('/admin/kelola-user', function () {
    return view('admin.kelola-user.index');
});

Route::get('/admin/kelola-diskon', function () {
    return view('admin.diskon.index');
});
