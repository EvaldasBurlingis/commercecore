<?php

namespace Database\Factories;

use App\Enums\OrderStatusEnums;
use App\Enums\PaymentMethodEnums;
use App\Enums\PaymentStatusEnums;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => Customer::factory(),
            'total_price' => $this->faker->numberBetween(100, 100000),
            'status' => $this->faker->randomElement(OrderStatusEnums::toArray()),
            'shipping_address' => $this->faker->address,
            'shipping_country' => $this->faker->country,
            'shipping_state' => $this->faker->state,
            'shipping_postal_code' => $this->faker->postcode,
            'payment_method' => PaymentMethodEnums::CREDIT_CARD,
            'payment_status' => $this->faker->randomElement(PaymentStatusEnums::toArray()),
            'cc_number' => $this->faker->creditCardNumber,
            'cc_expiration_date' => $this->faker->creditCardExpirationDate,
        ];
    }
}
