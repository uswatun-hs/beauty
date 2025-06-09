<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admin\DashboardAdminController;
//use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\ManajemenUserController;
use App\Http\Controllers\admin\KaryawanController;
use App\Http\Controllers\admin\LayananController as AdminLayananController;
use App\Http\Controllers\pelanggan\DashboardPelangganController;
use App\Http\Controllers\pelanggan\KeranjangController;
use App\Http\Controllers\pelanggan\OrderController;
//use App\Http\Controllers\pelanggan\CartController;
//use App\Http\Controllers\pelanggan\OrderController;
use App\Http\Controllers\admin\OrderController as AdminOrderController;
use App\Http\Controllers\pelanggan\LayananController as PelangganLayananController;


// Routes untuk admin (dengan RoleMiddleware jika ingin batasi akses hanya untuk admin)
Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard');
        Route::resource('manajemen_user', ManajemenUserController::class);
        Route::resource('karyawan', KaryawanController::class);
        Route::resource('layanan', AdminLayananController::class);
        Route::resource('order', AdminOrderController::class)->only(['index']);
        Route::put('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
        // Pastikan nama route diawali 'order.' agar prefix 'admin.' + 'order.konfirmasiPembayaran'
        Route::post('order/{order}/konfirmasi-pembayaran', [AdminOrderController::class, 'konfirmasiPembayaran'])->name('order.konfirmasiPembayaran');
    });

Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':pelanggan'])
    ->prefix('pelanggan')
    ->name('pelanggan.')
    ->group(function () {
        Route::get('/dashboard', [DashboardPelangganController::class, 'index'])->name('dashboard');
        Route::resource('layanan', PelangganLayananController::class);
        Route::resource('keranjang', KeranjangController::class)->only(['index', 'store']);
        Route::delete('keranjang/{id}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');
        Route::put('keranjang/{id}', [KeranjangController::class, 'update'])->name('keranjang.update');
        Route::resource('order', OrderController::class)->only(['index', 'store', 'destroy']);
        Route::post('/order/{order}/upload-bukti', [OrderController::class, 'uploadBukti'])->name('order.uploadBukti');
        // Ini sesuaikan URL-nya jadi konsisten dengan prefix 'order' (bukan 'orders')
        Route::get('/order/{order}/payment', [OrderController::class, 'paymentForm'])->name('order.paymentForm');
        Route::post('/order/{order}/payment', [OrderController::class, 'processPayment'])->name('order.processPayment');
    });



// ...z




// Profile user
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});





// Auth routes dari Breeze
require __DIR__ . '/auth.php';
