<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\Admin\AdminAccountController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Models\CartItem;
use Illuminate\Support\Facades\Route;

// Rute Publik (tanpa login)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kontak', [ContactController::class, 'index'])->name('kontak');
Route::get('/produk/{product}', [ProductController::class, 'show'])->name('product.show');

// Rute Autentikasi
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute Pengguna (harus login)
Route::middleware(['web', 'auth'])->group(function () {
    // Rute Keranjang
    Route::post('/produk/{product}/tambah-keranjang', [CartController::class, 'store'])->name('cart.add');

    Route::prefix('keranjang')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::put('/update/{item}', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/hapus/{item}', [CartController::class, 'destroy'])->name('cart.remove'); // tetap POST
    });

    Route::post('/keranjang/id', [CartController::class, 'confirm'])->name('cart.confirm');
    Route::get('/terima-kasih', [CartController::class, 'thankYou'])->name('cart.thankyou');
});

Route::prefix('admin')->group(function () {

    // Login Admin (guest)
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [AdminAuthController::class, 'showLoginForm'])
            ->name('admin.login');
        Route::post('login', [AdminAuthController::class, 'login'])
            ->name('admin.login.submit');
    });

    // Logout Admin
    Route::post('logout', [AdminAuthController::class, 'logout'])
        ->name('admin.logout');

    // Rute yang membutuhkan autentikasi admin + auto logout
    Route::middleware(['auth:admin', 'admin.autologout'])->group(function () {

        // Dashboard
        Route::get('dashboard', [AdminController::class, 'dashboard'])
            ->name('admin.dashboard');

        // Manajemen Produk
        Route::resource('products', AdminController::class)->names([
            'index' => 'admin.products.index',
            'create' => 'admin.products.create',
            'store' => 'admin.products.store',
            'show' => 'admin.products.show',
            'edit' => 'admin.products.edit',
            'update' => 'admin.products.update',
            'destroy' => 'admin.products.destroy',
        ]);

        // Manajemen User
        Route::resource('users', UserController::class)->names([
            'index' => 'admin.users.index',
            'create' => 'admin.users.create',
            'store' => 'admin.users.store',
            'edit' => 'admin.users.edit',
            'update' => 'admin.users.update',
            'destroy' => 'admin.users.destroy',
        ])->except(['show']);

        // Manajemen Penjualan
        Route::prefix('penjualan')->group(function () {
            Route::get('/', [SalesController::class, 'index'])
                ->name('admin.sales.index');
            Route::get('/{order}', [SalesController::class, 'show'])
                ->name('admin.sales.show');
            Route::delete('/{order}', [SalesController::class, 'destroy'])
                ->name('admin.sales.destroy');
            Route::post('/{order}/update-status', [SalesController::class, 'updateStatus'])
                ->name('admin.sales.update-status');
        });

        // Manajemen Akun Admin
        Route::prefix('akun')->group(function () {

            // Profil Admin
            Route::get('profil', [AdminAccountController::class, 'editProfile'])
                ->name('admin.account.profile');
            Route::put('profil', [AdminAccountController::class, 'updateProfile'])
                ->name('admin.account.profile.update');

            // Ubah Password Admin
            Route::get('password', [AdminAccountController::class, 'editPassword'])
                ->name('admin.account.change-password');
            Route::put('password', [AdminAccountController::class, 'updatePassword'])
                ->name('admin.account.change-password.update');
        });
    });
});
