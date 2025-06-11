<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\admin\DashboardAdminController;
use App\Http\Controllers\admin\ManajemenUserController;
use App\Http\Controllers\admin\KaryawanController;
use App\Http\Controllers\admin\OrderController as AdminOrderController;
use App\Http\Controllers\admin\LayananController as AdminLayananController;
use App\Http\Controllers\admin\UlasanController as AdminUlasanController;
use App\Http\Controllers\pelanggan\DashboardPelangganController;
use App\Http\Controllers\pelanggan\KeranjangController;
use App\Http\Controllers\pelanggan\OrderController;
use App\Http\Controllers\pelanggan\UlasanController as PelangganUlasanController;
use App\Http\Controllers\pelanggan\LayananController as PelangganLayananController;
use App\Http\Controllers\karyawan\OrderController as KaryawanOrderController;
use App\Http\Controllers\karyawan\DashboardKaryawanController;
use App\Http\Controllers\karyawan\UlasanController as KaryawanUlasanController;
use App\Http\Controllers\owner\DashboardOwnerController;
use App\Http\Controllers\owner\KaryawanController as OwnerKaryawanController;
use App\Http\Controllers\owner\ManajemenUserController as OwnerManajemenUserController;
use App\Http\Controllers\owner\LayananController as OwnerLayananController;
use App\Http\Controllers\owner\OrderController as OwnerOrderController;
use App\Http\Controllers\owner\UlasanController as OwnerUlasanController;

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
        Route::post('order/{order}/konfirmasi-pembayaran', [AdminOrderController::class, 'konfirmasiPembayaran'])->name('order.konfirmasiPembayaran');
        Route::resource('ulasan', AdminUlasanController::class);
        Route::post('/midtrans/notification', [App\Http\Controllers\PaymentController::class, 'handleNotification']);

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
        // Route::post('/order/{order}/upload-bukti', [OrderController::class, 'uploadBukti'])->name('order.uploadBukti');
        // Route::get('/order/{order}/payment', [OrderController::class, 'paymentForm'])->name('order.paymentForm');
        Route::post('/order/{order}/payment', [OrderController::class, 'processPayment'])->name('order.processPayment');
        Route::resource('ulasan', PelangganUlasanController::class);
        //Route::post('/midtrans/callback', [PaymentController::class, 'callback']);
        // Di dalam group prefix 'pelanggan'...

        // Tampilkan form bayar
        Route::get('/order/{order}/payment', [PaymentController::class, 'form'])->name('order.paymentForm');

        // Proses Midtrans (pakai snap token)
        Route::post('/order/{order}/checkout', [PaymentController::class, 'process'])->name('order.checkout');

        // Callback dari Midtrans
        Route::post('/midtrans/callback', [PaymentController::class, 'callback']);

        // (Optional) Route dummy untuk testing
        Route::get('/checkout', [PaymentController::class, 'showForm'])->name('checkout.form');
        Route::post('/checkout', [PaymentController::class, 'checkout'])->name('checkout.dummy');
    });

Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':karyawan'])
    ->prefix('karyawan')
    ->name('karyawan.')
    ->group(function () {
        Route::get('/dashboard', [DashboardKaryawanController::class, 'index'])->name('dashboard');
        Route::resource('order', KaryawanOrderController::class)->only(['index']);
        Route::put('orders/{order}/status', [KaryawanOrderController::class, 'updateStatus'])->name('orders.updateStatus');
        Route::post('order/{order}/konfirmasi-pembayaran', [KaryawanOrderController::class, 'konfirmasiPembayaran'])->name('order.konfirmasiPembayaran');
        Route::resource('ulasan', KaryawanUlasanController::class);
    });

Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':owner'])
    ->prefix('owner')
    ->name('owner.')
    ->group(function () {
        Route::get('/dashboard', [DashboardOwnerController::class, 'index'])->name('dashboard');
        Route::resource('manajemen_user', OwnerManajemenUserController::class);
        Route::resource('karyawan', OwnerKaryawanController::class);
        Route::resource('layanan', OwnerLayananController::class);
        Route::resource('order', OwnerOrderController::class)->only(['index']);
        Route::post('order/{order}/konfirmasi-pembayaran', [OwnerOrderController::class, 'konfirmasiPembayaran'])->name('order.konfirmasiPembayaran');
        Route::resource('ulasan', OwnerUlasanController::class);
    });

// Profile user
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes dari Breeze
require __DIR__ . '/auth.php';
