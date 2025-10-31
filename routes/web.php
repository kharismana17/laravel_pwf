<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DataDiriController;
use App\Http\Controllers\AktivitasController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;

// Halaman utama user
Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/datadiri', [DataDiriController::class, 'index'])->name('datadiri');
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::post('/submit-kontak', [KontakController::class, 'kirim'])->name('submit.kontak');

// Aktivitas (CRUD)
Route::resource('aktivitas', AktivitasController::class)->names([
    'index' => 'aktivitas.index',
    'create' => 'aktivitas.create',
    'store' => 'aktivitas.store',
    'edit' => 'aktivitas.edit',
    'update' => 'aktivitas.update',
    'destroy' => 'aktivitas.destroy',
]);

// Grup khusus admin
Route::prefix('admin')->name('admin.')->group(function () {

    // Halaman login admin
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Halaman admin yang butuh login
    Route::middleware(['auth', 'is_admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });
});

// Alias supaya middleware auth tahu kemana redirect jika belum login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
