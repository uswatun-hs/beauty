<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admin\DashboardAdminController;
use App\Http\Controllers\admin\ManajemenUserController;
use App\Http\Controllers\admin\KaryawanController;
use App\Http\Controllers\admin\LayananController as AdminLayananController;
use App\Http\Controllers\pelanggan\DashboardPelangganController;
//use App\Http\Controllers\pelanggan\CartController;
//use App\Http\Controllers\pelanggan\OrderController;
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
    });

Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':pelanggan'])
    ->prefix('pelanggan')
    ->name('pelanggan.')
    ->group(function () {
        Route::get('/dashboard', [DashboardPelangganController::class, 'index'])->name('dashboard');
        Route::resource('layanan', PelangganLayananController::class);
        // ...
    });




// Profile user
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});





// Auth routes dari Breeze
require __DIR__ . '/auth.php';
