<?php

use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\CountryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'countries'], function () {
    Route::get('/', [CountryController::class, 'getCountries'])->name('api.countries.index');
    Route::get('/{country}/states', [CountryController::class, 'getStates'])->name('api.countries.states.index');
});

Route::delete('/cart/{cart}/items/{item}', [CartController::class, 'deleteCartItem'])->name('api.cart.item.delete');
