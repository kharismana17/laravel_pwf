<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SalesReportController;

Route::get('/', function() {
    return redirect()->route('products.index');
});

// Public auth routes
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.post');

    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register'])->name('register.post');
});

Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Authenticated routes
Route::middleware(['auth'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    // Label printing (VERY IMPORTANT – must be above resource)
    Route::get('products/labels', [ProductController::class, 'labels'])->name('products.labels');
    Route::get('products/labels/print', [ProductController::class, 'printLabels'])->name('products.labels.print');

    // Resource
    Route::resource('products', ProductController::class);

    // Stock routes
    Route::get('products/{product}/stock-in', [StockController::class, 'createIn'])->name('products.stock.in');
    Route::get('products/{product}/stock-out', [StockController::class, 'createOut'])->name('products.stock.out');
    Route::post('products/{product}/stock', [StockController::class, 'store'])->name('products.stock.store');

    // Reports
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/sales', [SalesReportController::class, 'index'])->name('reports.sales');
});
