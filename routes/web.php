<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\ManajemenUserController;
use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\Admin\LayananController;

// Routes untuk admin (dengan RoleMiddleware jika ingin batasi akses hanya untuk admin)
Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':admin'])
    ->prefix('admin')
    ->name('admin.') // prefix nama route jadi admin.*
    ->group(function () {
        Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard');
        Route::resource('manajemen_user', ManajemenUserController::class);
        Route::resource('karyawan', KaryawanController::class);
        Route::resource('layanan', LayananController::class);
    });



// Profile user
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});





// Auth routes dari Breeze
require __DIR__.'/auth.php';
