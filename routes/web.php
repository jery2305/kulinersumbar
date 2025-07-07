<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Controller umum
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;

// Admin
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\MenuAdminController;
use App\Http\Controllers\Admin\OrderAdminController;
use App\Http\Controllers\Admin\OrderItemAdminController;
use App\Http\Controllers\Admin\ContactAdminController;
use App\Http\Controllers\Admin\RatingAdminController;


//Route::get('/', function () {
//    return view('welcome');
// });

//Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

//Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Google OAuth routes
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

//Logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

//Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
});

//Home
Route::get('/', [HomeController::class, 'index'])->name('home');

//About
Route::get('/about', [AboutController::class, 'index']);

//Menu
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::post('/pesan', [MenuController::class, 'pesan'])->name('pesan');
Route::post('/menu/{menuId}/review', [MenuController::class, 'addReview'])->name('menu.addReview');
Route::get('/menu/{id}/review', [MenuController::class, 'reviewPage'])->name('menu.reviewPage');

//Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

// Cart
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
});

// Checkout
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('process-checkout');
Route::get('/checkout/success', [CartController::class, 'success'])->name('checkout.success');

//Oder
Route::middleware('auth')->group(function () {
    Route::get('/orders', [OrderController::class, 'history'])->name('orders.history');
    Route::post('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.update.status');
    Route::post('/orders/{order}/upload-bukti', [OrderController::class, 'uploadBukti'])->name('orders.uploadBukti');
    Route::patch('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::patch('/orders/{id}/selesai', [OrderController::class, 'konfirmasiSelesai'])->name('orders.konfirmasiSelesai');
});



//FAQ
Route::get('/faq', function () {
    return view('pages.faq');
})->name('faq');
//syarat
Route::get('/syarat', function () {
    return view('pages.syarat');
})->name('syarat');
//PRIVASI
Route::get('/privasi', function () {
    return view('pages.privasi');
})->name('privasi');
//PENGIRIMAN
Route::get('/pengiriman', function () {
    return view('pages.pengiriman');
})->name('pengiriman');




// ------------------------
// Admin Dashboard
// ------------------------
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});

// ------------------------
// User Management
// ------------------------
Route::middleware(['auth'])->prefix('admin/user')->name('admin.user.')->group(function () {
    Route::get('/', [UserAdminController::class, 'index'])->name('index');
    Route::delete('/{user}', [UserAdminController::class, 'destroy'])->name('destroy');
});

// ------------------------
// Menu Management
// ------------------------
Route::middleware(['auth'])->prefix('admin/menu')->name('admin.menu.')->group(function () {
    Route::get('/', [MenuAdminController::class, 'index'])->name('index');
    Route::get('/create', [MenuAdminController::class, 'create'])->name('create');
    Route::post('/', [MenuAdminController::class, 'store'])->name('store');
    Route::get('/{menu}/edit', [MenuAdminController::class, 'edit'])->name('edit');
    Route::put('/{menu}', [MenuAdminController::class, 'update'])->name('update');
    Route::delete('/{menu}', [MenuAdminController::class, 'destroy'])->name('destroy');
});

// ------------------------
// Order Management
// ------------------------
Route::middleware(['auth'])->prefix('admin/order')->name('admin.order.')->group(function () {
    Route::get('/', [OrderAdminController::class, 'index'])->name('index');
    Route::get('/form/{id}', [OrderAdminController::class, 'form'])->name('form');
    Route::put('/update/{id}', [OrderAdminController::class, 'update'])->name('update');
    Route::post('/confirm/{id}', [OrderAdminController::class, 'confirm'])->name('confirm');
    Route::post('/upload-bukti/{id}', [OrderAdminController::class, 'uploadBukti'])->name('uploadBukti');
});

// ------------------------
// Order Item Management
// ------------------------
Route::middleware(['auth'])->prefix('admin/orderitem')->name('admin.orderitem.')->group(function () {
    Route::get('/', [OrderItemAdminController::class, 'index'])->name('index');
    Route::get('/form/{id?}', [OrderItemAdminController::class, 'form'])->name('form');
    Route::post('/', [OrderItemAdminController::class, 'store'])->name('store');
    Route::put('/{id}', [OrderItemAdminController::class, 'update'])->name('update');
    Route::delete('/{id}', [OrderItemAdminController::class, 'destroy'])->name('destroy');
});

// ------------------------
// Contact Management
// ------------------------
Route::middleware(['auth'])->prefix('admin/contact')->name('admin.contact.')->group(function () {
    Route::get('/', [ContactAdminController::class, 'index'])->name('index');
    Route::delete('/{contact}', [ContactAdminController::class, 'destroy'])->name('destroy');
});

// ------------------------
// Rating Management
// ------------------------
Route::middleware(['auth'])->prefix('admin/rating')->name('admin.rating.')->group(function () {
    Route::get('/', [RatingAdminController::class, 'index'])->name('index');
    Route::delete('/{rating}', [RatingAdminController::class, 'destroy'])->name('destroy');
});

