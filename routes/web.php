<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Auth
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisterController;

// Public pages
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MenuController;

// Features
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;

// Admin
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\MenuAdminController;
use App\Http\Controllers\Admin\OrderAdminController;
use App\Http\Controllers\Admin\OrderItemAdminController;
use App\Http\Controllers\Admin\ContactAdminController;
use App\Http\Controllers\Admin\RatingAdminController;

// ====================
// AUTH
// ====================
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');


// ====================
// PUBLIC PAGES
// ====================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index']);
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

// FAQ & Informasi Tambahan
Route::view('/faq', 'pages.faq')->name('faq');
Route::view('/syarat', 'pages.syarat')->name('syarat');
Route::view('/privasi', 'pages.privasi')->name('privasi');
Route::view('/pengiriman', 'pages.pengiriman')->name('pengiriman');

// ====================
// AUTHENTICATED ROUTES
// ====================
Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('process-checkout');
    Route::get('/checkout/success', [CartController::class, 'success'])->name('checkout.success');

    // Orders
    Route::get('/orders', [OrderController::class, 'history'])->name('orders.history');
    Route::post('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.update.status');
    Route::post('/orders/{order}/upload-bukti', [OrderController::class, 'uploadBukti'])->name('orders.uploadBukti');
    Route::patch('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::patch('/orders/{id}/selesai', [OrderController::class, 'konfirmasiSelesai'])->name('orders.konfirmasiSelesai');

    // Menu review
    Route::post('/menu/{menuId}/review', [MenuController::class, 'addReview'])->name('menu.addReview');
    Route::get('/menu/{id}/review', [MenuController::class, 'reviewPage'])->name('menu.reviewPage');


    // ====================
    // ADMIN AREA
    // ====================
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Daftar Users
    Route::prefix('admin/user')->name('admin.user.')->group(function () {
        Route::get('/', [UserAdminController::class, 'index'])->name('index');
        Route::delete('/{user}', [UserAdminController::class, 'destroy'])->name('destroy');
    });

    // Daftar Menu
    Route::prefix('admin/menu')->name('admin.menu.')->group(function () {
        Route::get('/', [MenuAdminController::class, 'index'])->name('index');
        Route::get('/create', [MenuAdminController::class, 'create'])->name('create');
        Route::post('/', [MenuAdminController::class, 'store'])->name('store');
        Route::get('/{menu}/edit', [MenuAdminController::class, 'edit'])->name('edit');
        Route::put('/{menu}', [MenuAdminController::class, 'update'])->name('update');
        Route::delete('/{menu}', [MenuAdminController::class, 'destroy'])->name('destroy');
    });

    // Daftar Orders
    Route::prefix('admin/order')->name('admin.order.')->group(function () {
        Route::get('/', [OrderAdminController::class, 'index'])->name('index');
        Route::get('/form/{id}', [OrderAdminController::class, 'form'])->name('form');
        Route::put('/update/{order}', [OrderAdminController::class, 'update'])->name('update');
        Route::post('/confirm/{id}', [OrderAdminController::class, 'confirm'])->name('confirm');
        Route::post('/upload-bukti/{id}', [OrderAdminController::class, 'uploadBukti'])->name('uploadBukti');
    });
    
    // Daftar Order Items
    Route::prefix('admin/orderitem')->name('admin.orderitem.')->group(function () {
        Route::get('/', [OrderItemAdminController::class, 'index'])->name('index');
        Route::get('/form/{id?}', [OrderItemAdminController::class, 'form'])->name('form');
        Route::post('/', [OrderItemAdminController::class, 'store'])->name('store');
        Route::delete('/{id}', [OrderItemAdminController::class, 'destroy'])->name('destroy');
    });

    // Daftar Contacts
    Route::prefix('admin/contact')->name('admin.contact.')->group(function () {
        Route::get('/', [ContactAdminController::class, 'index'])->name('index');
        Route::delete('/{contact}', [ContactAdminController::class, 'destroy'])->name('destroy');
    });

    // Dafatar Ratings
    Route::prefix('admin/rating')->name('admin.rating.')->group(function () {
        Route::get('/', [RatingAdminController::class, 'index'])->name('index');
        Route::delete('/{rating}', [RatingAdminController::class, 'destroy'])->name('destroy');
    });
});
