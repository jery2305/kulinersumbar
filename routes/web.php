<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('welcome');
});

//Home
Route::get('/', [HomeController::class, 'index']);

//About
Route::get('/about', [AboutController::class, 'index']);

//Menu


//Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send'); // Pengiriman Form Kontak
