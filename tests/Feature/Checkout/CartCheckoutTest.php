<?php

use App\Models\Cart;
use App\Notifications\OrderReceived;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\Facades\Notification;
use Inertia\Testing\AssertableInertia;

beforeEach(function () {
    $this->seed();
});

test('can access checkout page', function () {
    $response = $this->get(route('checkout'));

    $response->assertStatus(200);
    $response->assertInertia(function (AssertableInertia $page) {
        $page->component('Checkout');
    });
});

test('can checkout', function () {
    $cart = Cart::first();

    $response = $this->post(route('cart.checkout', $cart), [
        'customer_first_name' => 'John',
        'customer_last_name' => 'Doe',
        'customer_address' => '123 Main St',
        'customer_country' => 'US',
        'customer_state' => 'CA',
        'customer_postal_code' => '90210',
        'cc_number' => '4111111111111111',
        'cc_expiration_date' => '12/25',
        'cc_cvv' => '123',
    ]);

    $response->assertStatus(302);
    $response->assertRedirect(route('checkout-success'));
});

test('checkout validation', function () {
    $cart = Cart::first();

    $response = $this->post(route('cart.checkout', $cart), [
        'customer_first_name' => '',
        'customer_last_name' => '',
        'customer_address' => '',
        'customer_country' => '',
        'customer_state' => '',
        'customer_postal_code' => '',
        'cc_number' => '',
        'cc_expiration_date' => '',
        'cc_cvv' => '',
    ]);

    $response->assertStatus(302);
    $response->assertSessionHasErrors([
        'customer_first_name',
        'customer_last_name',
        'customer_address',
        'customer_country',
        'customer_state',
        'customer_postal_code',
        'cc_number',
        'cc_expiration_date',
        'cc_cvv',
    ]);
});

test('Order received job is dispatched when checking out', function () {
    Notification::fake();
    $this->withoutExceptionHandling();

    $cart = Cart::first();

    $response = $this->post(route('cart.checkout', $cart), [
        'customer_first_name' => 'John',
        'customer_last_name' => 'Doe',
        'customer_address' => '123 Main St',
        'customer_country' => 'US',
        'customer_state' => 'CA',
        'customer_postal_code' => '90210',
        'cc_number' => '4111111111111111',
        'cc_expiration_date' => '12/25',
        'cc_cvv' => '123',
    ]);

    Notification::assertSentTo(new AnonymousNotifiable, OrderReceived::class);

    $response->assertStatus(302);
    $response->assertRedirect(route('checkout-success'));
});
