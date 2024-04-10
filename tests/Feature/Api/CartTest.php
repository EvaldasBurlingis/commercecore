<?php

use App\Models\Cart;
use App\Models\CartItem;
use Symfony\Component\HttpFoundation\Response;

test('can delete a cart item', function () {
    $cart = Cart::factory()->create();
    $item = CartItem::factory()->create(['cart_id' => $cart->id]);

    $response = $this->delete(route('api.cart.item.delete', [$cart, $item]));

    $response->assertStatus(Response::HTTP_OK);
})->group('api');
