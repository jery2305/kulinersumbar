<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisterController;

//AdminController
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\MenuAdminController;

//Route::get('/', function () {
//    return view('welcome');
// });

//Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

//Login
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

//Logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

//Home
Route::get('/', [HomeController::class, 'index'])->name('home');

//About
Route::get('/about', [AboutController::class, 'index']);

//Menu
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::post('/pesan', [MenuController::class, 'pesan'])->name('pesan');
Route::post('/menu/{menuId}/review', [MenuController::class, 'addReview'])->name('menu.addReview');

//Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send'); // Pengiriman Form Kontak

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');

// Checkout
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('process-checkout');
Route::get('/checkout/success', [CartController::class, 'success'])->name('checkout.success');

//Oder
Route::middleware('auth')->group(function () {
    Route::get('/orders', [OrderController::class, 'history'])->name('orders.history');
    Route::post('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.update.status');
});

//team
Route::view('/team', 'pages.team')->name('team');

//FAQ
Route::get('/faq', function () {
    return view('pages.faq');
})->name('faq');



//AdminController

//Admin
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});

//User
Route::middleware(['auth'])->prefix('admin/user')->name('admin.user.')->group(function () {
    Route::get('/', [UserAdminController::class, 'index'])->name('index');
    Route::get('/create', [UserAdminController::class, 'create'])->name('create');
    Route::post('/', [UserAdminController::class, 'store'])->name('store');
    Route::get('/{user}/edit', [UserAdminController::class, 'edit'])->name('edit');
    Route::put('/{user}', [UserAdminController::class, 'update'])->name('update');
    Route::delete('/{user}', [UserAdminController::class, 'destroy'])->name('destroy');
});

//Menu
Route::middleware(['auth'])->prefix('admin/menu')->name('admin.menu.')->group(function () {
    Route::get('/', [MenuAdminController::class, 'index'])->name('index');
    Route::get('/create', [MenuAdminController::class, 'create'])->name('create');
    Route::post('/', [MenuAdminController::class, 'store'])->name('store');
    Route::get('/{menu}/edit', [MenuAdminController::class, 'edit'])->name('edit');
    Route::put('/{menu}', [MenuAdminController::class, 'update'])->name('update');
    Route::delete('/{menu}', [MenuAdminController::class, 'destroy'])->name('destroy');
});
