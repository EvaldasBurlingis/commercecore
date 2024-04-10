<?php

namespace App\Services;

use App\Enums\OrderStatusEnums;
use App\Enums\PaymentMethodEnums;
use App\Enums\PaymentStatusEnums;
use App\Http\Requests\Cart\CartCheckoutRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Notifications\OrderReceived;
use App\Services\Interfaces\ICheckoutService;
use Illuminate\Support\Facades\Notification;
use JetBrains\PhpStorm\NoReturn;

class CheckoutService implements ICheckoutService
{
    #[NoReturn] public function cartCheckout(Cart $cart, CartCheckoutRequest $request): void
    {
        // Create customer from request
        $customer = $cart->customer()->create([
            'first_name' => $request->customer_first_name,
            'last_name' => $request->customer_last_name,
        ]);

        // Create order from cart
        $order = new Order();
        $order->fill([
            'total_price' => $cart->total,
            'shipping_address' => $request->customer_address,
            'shipping_country' => $request->customer_country,
            'shipping_state' => $request->customer_state,
            'shipping_postal_code' => $request->customer_postal_code,
            'payment_method' => PaymentMethodEnums::CREDIT_CARD,
            'cc_number' => $request->cc_number,
            'cc_expiration' => $request->cc_expiration_date,
        ]);

        $order->customer()->associate($customer);
        $order->save();

        // process order through payment gateway
        // START: simulate payment gateway
        sleep(2);
        $order->update([
            'status' => OrderStatusEnums::PROCESSING,
            'payment_status' => PaymentStatusEnums::PAID,
        ]);
        // END: simulate payment gateway

        // send email after 5minutes with order details to email from env
        Notification::route('mail', config('mail.order.received.address'))
            ->notify(new OrderReceived($order));
    }
}
