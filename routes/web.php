<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Barang\BarangController;
use App\Http\Controllers\Diskon\DiskonController;
use App\Http\Controllers\Pesanan\PesananController;
use App\Http\Controllers\Keranjang\KeranjangController;
use App\Http\Controllers\Barang\KategoriBarangController;
use App\Http\Controllers\Checkout\CheckOutController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\DataSewa\DataSewaController;
use App\Http\Controllers\Diskon\KategoriDiskonController;
use App\Http\Controllers\Pembayaran\PembayaranController;
use App\Http\Controllers\Keranjang\KeranjangItemController;
use App\Http\Controllers\Riwayatpesanan\RiwayatPesananController;

// Landing Page ===========================//
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [BarangController::class, 'barangLandingPage']);

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


// ==================== A D M I N =============================================//
Route::middleware(['role:superadmin|admin'])->group(function () {

    // Dashboard ======================================================//  
    Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/get-monthly-revenue-data', [DashboardController::class, 'getMonthlyRevenueData']);


    Route::get('/admin/profile', function () {
        return view('admin.profile');
    })->name('admin.profile');

    // Data Barang ===================================================== //
    Route::get('/admin/data-barang', [BarangController::class, 'index'])->name('data-barang.index');
    Route::get('/admin/data-barang/create', [BarangController::class, 'create'])->name('data-barang.create');
    Route::post('/admin/data-barang/store', [BarangController::class, 'store'])->name('data-barang.store');
    Route::get('/admin/data-barang/edit/{id}', [BarangController::class, 'edit'])->name('data-barang.edit');
    Route::put('/admin/data-barang/update/{id}', [BarangController::class, 'update'])->name('data-barang.update');
    Route::delete('/admin/data-barang/delete/{id}', [BarangController::class, 'destroy'])->name('data-barang.destroy');
    Route::get('/admin/data-barang/lihat-barang/{id}', [BarangController::class, 'show'])->name('data-barang.show');
    Route::get('/get-kode-barang/{kategoriId}', [BarangController::class, 'getKodeBarang']);
    Route::delete('/data-barang/destroy-selected', [BarangController::class, 'destroySelected'])->name('data-barang.destroySelected');

    // Kategori Barang ================================================== //
    Route::get('/admin/kategori-barang', [KategoriBarangController::class, 'index'])->name('kategori-barang.index');
    Route::get('/admin/kategori-barang/create', [KategoriBarangController::class, 'create'])->name('kategori-barang.create');
    Route::post('/admin/kategori-barang/store', [KategoriBarangController::class, 'store'])->name('kategori-barang.store');
    Route::get('/admin/kategori-barang/edit/{id}', [KategoriBarangController::class, 'edit'])->name('kategori-barang.edit');
    Route::put('/admin/kategori-barang/update/{id}', [KategoriBarangController::class, 'update'])->name('kategori-barang.update');
    Route::delete('/admin/kategori-barang/delete/{id}', [KategoriBarangController::class, 'destroy'])->name('kategori-barang.destroy');
    Route::delete('/kategori-barang/destroy-selected', [KategoriBarangController::class, 'destroySelected'])->name('kategori-barang.destroySelected');


    // Data Sewa ===================================================== //
    Route::get('/admin/data-sewa', [DataSewaController::class, 'index'])->name('admin.data-sewa.index');



    // kelola pelanggan ===================================================== //
    Route::get('/admin/kelola-pelanggan', [UserController::class, 'index'])->name('kelola-pelanggan');
    Route::post('/kelola-pelanggan/pelanggan/{id}/suspend', [UserController::class, 'suspendUser'])->name('pelanggan.suspend');
    Route::post('/kelola-pelanggan/pelanggan/{id}/un-suspend', [UserController::class, 'unsuspendUser'])->name('pelanggan.un-suspend');
    Route::post('/kelola-pelanggan/pelanggan/{id}/banned', [UserController::class, 'banUser'])->name('pelanggan.banned');
    Route::get('/admin/tambah-admin', [UserController::class, 'tambahAdminPage'])->name('tambah-admin');
    Route::post('/admin/store', [UserController::class, 'tambahAdmin'])->name('admin.store')->middleware('role:superadmin'); // Hanya superadmin yang bisa tambah admin
    Route::get('/admin/kelola-pelanggan/lihat-pelanggan/{id}', [UserController::class, 'lihatPelanggan'])->name('pelanggan.show');
    Route::delete('/kelola-pelanggan/pelanggan/{id}', [UserController::class, 'hapusPelanggan'])->name('kelola-pelanggan.destroy');

    // kelola-diskon ===================================================== //
    Route::get('/admin/kelola-diskon', [DiskonController::class, 'index'])->name('diskon.index');
    Route::get('/admin/kelola-diskon/create', [DiskonController::class, 'create'])->name('diskon.create');
    Route::post('/admin/kelola-diskon/store', [DiskonController::class, 'store'])->name('diskon.store');
    Route::get('/admin/kelola-diskon/edit/{id}', [DiskonController::class, 'edit'])->name('diskon.edit');
    Route::put('/admin/kelola-diskon/update/{id}', [DiskonController::class, 'update'])->name('diskon.update');
    Route::delete('/admin/kelola-diskon/delete/{id}', [DiskonController::class, 'destroy'])->name('diskon.destroy');
    Route::delete('/kelola-diskon/destroy-selected', [DiskonController::class, 'destroySelected'])->name('diskon.destroySelected');

    // Kategori Diskon ================================================== //
    Route::get('/admin/kategori-diskon', [KategoriDiskonController::class, 'index'])->name('kategori-diskon.index');
    Route::get('/admin/kategori-diskon/create', [KategoriDiskonController::class, 'create'])->name('kategori-diskon.create');
    Route::post('/admin/kategori-diskon/store', [KategoriDiskonController::class, 'store'])->name('kategori-diskon.store');
    Route::get('/admin/kategori-diskon/edit/{id}', [KategoriDiskonController::class, 'edit'])->name('kategori-diskon.edit');
    Route::put('/admin/kategori-diskon/update/{id}', [KategoriDiskonController::class, 'update'])->name('kategori-diskon.update');
    Route::delete('/admin/kategori-diskon/delete/{id}', [KategoriDiskonController::class, 'destroy'])->name('kategori-diskon.destroy');
    Route::delete('/kategori-diskon/destroy-selected', [KategoriDiskonController::class, 'destroySelected'])->name('kategori-diskon.destroySelected');

    // Laporan Admin ===================================================== //
    Route::get('/admin/laporan-goodrent', function () {
        return view('admin.laporan.index');
    })->name('admin.laporan.index');
});


// ====================== U S E R ====================================== //
Route::middleware(['role:pelanggan'])->group(function () {

    // produk ============================================//
    Route::get('/goodrent/produk', [BarangController::class, 'lihatBarang'])->name('lihat.produk');

    Route::get('/goodrent/lihat-produk/{id}', [PesananController::class, 'detailProdukUser'])->name('produk.detail');
    Route::post('/goodrent/tambah/keranjang', [KeranjangController::class, 'addToCart'])->name('tambah.keranjang');
    Route::get('/goodrent/lihat-keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::delete('/keranjang/item/{id}', [KeranjangItemController::class, 'deleteItemFromCart'])->name('keranjang.hapusItem');
    
    Route::post('/goodrent/checkout', [CheckOutController::class, 'checkoutItems'])->name('checkout');
    Route::post('/goodrent/checkout/batalkan/{pesanan}', [CheckoutController::class, 'checkoutCancelled'])->name('checkout.batal');
    Route::get('/goodrent/checkout/summary/items/{id}', [CheckOutController::class, 'checkoutSummary'])->name('checkout.summary');

    Route::post('/goodrent/checkout/pakai-diskon', [DiskonController::class, 'applyDiscount'])->name('apply.discount');

    // profile ===========================================//
    Route::get('/goodrent/profile', function () {
        return view('user.profile');
    })->name('profile');

    Route::put('/edit-profil', [UserController::class, 'editProfilUser'])->name('edit.profil');

    Route::get('/goodrent/profile/alamat', function () {
        return view('user.alamat.index');
    })->name('user.alamat.index');

    Route::get('/goodrent/profile/tambah-alamat', function () {
        return view('user.alamat.create');
    })->name('user.alamat.create');

    Route::get('/goodrent/riwayat/pemesanan-saya', [RiwayatPesananController::class, 'userRiwayat'])->name('user.riwayat.index');

    Route::get('/goodrent/proses-pembayaran/{pesanan_id}', [PembayaranController::class, 'process'])->name('midtrans.process');
    Route::post('/goodrent/pembayaran/success', [PembayaranController::class, 'paymentSuccess'])->name('pembayaran.success');

    // Route::get('/checkout/{checkoutId}/payment', [PembayaranController::class, 'showPaymentForm'])->name('user.payment.index');
    // Route::post('/checkout/{checkoutId}/payment', [PembayaranController::class, 'processPayment'])->name('user.payment.process');
});
