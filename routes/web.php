<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
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
=======
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
>>>>>>> dd88429cb772beb31ee33a948f9d150d301ccb13
