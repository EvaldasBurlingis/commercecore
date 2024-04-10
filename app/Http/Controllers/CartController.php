<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cart\CartCheckoutRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Product;
use App\Services\Interfaces\ICheckoutService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class CartController extends Controller
{
    public function index(): Response
    {
        // START: Temp code for demo
        $cart = Cart::factory()->create();
        $products = Product::all();
        $cart->items()->createMany([
            ['product_id' => $products[0]->id, 'quantity' => 3, 'price' => $products[0]->price],
            ['product_id' => $products[1]->id, 'quantity' => 1, 'price' => $products[1]->price],
        ]);
        // END: Temp code for demo

        $cart->with(['items', 'items.product'])->get();

        $response = new CartResource($cart);
        $response->wrap(null);

        return Inertia::render('Checkout', [
            'cart' => $response,
        ]);
    }

    public function checkout(Cart $cart, CartCheckoutRequest $request, ICheckoutService $checkoutService): RedirectResponse
    {
        $checkoutService->cartCheckout($cart, $request);

        return to_route('checkout-success');
    }
}
