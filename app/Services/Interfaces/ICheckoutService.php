<?php

namespace App\Services\Interfaces;

use App\Http\Requests\Cart\CartCheckoutRequest;
use App\Models\Cart;

interface ICheckoutService
{
    public function cartCheckout(Cart $cart, CartCheckoutRequest $request): void;
}
