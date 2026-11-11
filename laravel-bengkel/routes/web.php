<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LayananMaintenanceController;
use App\Http\Controllers\AuthController;

// 1. Route Login & Logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 2. Route yang bisa diakses Admin & Petugas (Hanya untuk melihat data / index)
Route::middleware(['auth', 'role:admin,petugas'])->group(function () {
    Route::get('/', [LayananMaintenanceController::class, 'index'])->name('bengkel.index');
});

// 3. Route khusus HANYA UNTUK ADMIN (Tambah, Edit, Update, dan Hapus)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/bengkel/create', [LayananMaintenanceController::class, 'create'])->name('bengkel.create');
    Route::post('/bengkel', [LayananMaintenanceController::class, 'store'])->name('bengkel.store');
    Route::get('/bengkel/{id}/edit', [LayananMaintenanceController::class, 'edit'])->name('bengkel.edit');
    Route::put('/bengkel/{id}', [LayananMaintenanceController::class, 'update'])->name('bengkel.update');
    Route::delete('/bengkel/{id}', [LayananMaintenanceController::class, 'destroy'])->name('bengkel.destroy');
});