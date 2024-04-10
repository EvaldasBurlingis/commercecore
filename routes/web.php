<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn() => Inertia::render('Welcome'));
Route::get('/checkout-success', fn() => Inertia::render('CheckoutSuccess'))->name('checkout-success');

Route::get('/checkout', [CartController::class, 'index'])->name('checkout');
Route::post('cart/{cart}/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
