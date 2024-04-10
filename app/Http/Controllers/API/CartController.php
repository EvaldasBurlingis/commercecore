<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\CartItem;

class CartController extends Controller
{
    public function deleteCartItem(Cart $cart, CartItem $item): CartResource
    {
        $cart->items()->where('id', $item->id)->delete();
        $cart->refresh();

        return new CartResource($cart);
    }
}
