<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;



// Hanya boleh diakses sebelum login
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.post');

    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register'])->name('register.post');
});

// Logout
Route::post('logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');



Route::middleware(['auth'])->group(function () {

    // Default redirect ke halaman produk
    Route::get('/', fn() => redirect()->route('products.index'));

    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    // PRODUCTS CRUD
    Route::resource('products', ProductController::class);

    // STOCK IN / OUT
    Route::get('products/{product}/stock-in', [StockController::class, 'createIn'])
        ->name('products.stock.in');
    Route::get('products/{product}/stock-out', [StockController::class, 'createOut'])
        ->name('products.stock.out');
    Route::post('products/{product}/stock', [StockController::class, 'store'])
        ->name('products.stock.store');

    // REPORTS
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');

    // PRINT LABEL & NOTA
    Route::get('products/labels', [ProductController::class, 'labels'])->name('products.labels');
    Route::get('products/labels/print', [ProductController::class, 'printLabels'])->name('products.labels.print');
});
