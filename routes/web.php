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
use App\Http\Controllers\ProfileController;

//AdminController
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
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

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

//Order
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('order', [OrderAdminController::class, 'index'])->name('order.index');
    Route::get('order/form/{id?}', [OrderAdminController::class, 'form'])->name('order.form');
    Route::post('order/store', [OrderAdminController::class, 'store'])->name('order.store');
    Route::put('order/update/{id}', [OrderAdminController::class, 'update'])->name('order.update');
    Route::delete('order/delete/{id}', [OrderAdminController::class, 'destroy'])->name('order.destroy');
    Route::post('order/confirm/{id}', [OrderAdminController::class, 'confirm'])->name('order.confirm');
    Route::post('order/upload-bukti/{id}', [OrderAdminController::class, 'uploadBukti'])->name('order.uploadBukti');
});

//OrderItem
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('orderitem', [OrderItemAdminController::class, 'index'])->name('orderitem.index');
    Route::get('orderitem/form/{id?}', [OrderItemAdminController::class, 'form'])->name('orderitem.form');
    Route::post('orderitem', [OrderItemAdminController::class, 'store'])->name('orderitem.store');
    Route::put('orderitem/{id}', [OrderItemAdminController::class, 'update'])->name('orderitem.update');
    Route::delete('orderitem/{id}', [OrderItemAdminController::class, 'destroy'])->name('orderitem.destroy');
});

//Contact
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('contact', [ContactAdminController::class, 'index'])->name('contact.index');
    Route::get('contact/create', [ContactAdminController::class, 'create'])->name('contact.create');
    Route::post('contact', [ContactAdminController::class, 'store'])->name('contact.store');
    Route::get('contact/{contact}/edit', [ContactAdminController::class, 'edit'])->name('contact.edit');
    Route::put('contact/{contact}', [ContactAdminController::class, 'update'])->name('contact.update');
    Route::delete('contact/{contact}', [ContactAdminController::class, 'destroy'])->name('contact.destroy');
});

//Rating
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('rating', [RatingAdminController::class, 'index'])->name('rating.index');
    Route::get('rating/create', [RatingAdminController::class, 'create'])->name('rating.create');
    Route::post('rating', [RatingAdminController::class, 'store'])->name('rating.store');
    Route::get('rating/{rating}/edit', [RatingAdminController::class, 'edit'])->name('rating.edit');
    Route::put('rating/{rating}', [RatingAdminController::class, 'update'])->name('rating.update');
    Route::delete('rating/{rating}', [RatingAdminController::class, 'destroy'])->name('rating.destroy');
});
