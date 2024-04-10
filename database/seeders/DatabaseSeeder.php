<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Product::factory()->createMany([
                [
                    'name' => 'CoreProduct®',
                    'price' => 13.33,
                ],
                [
                    'name' => 'AddonCoreProduct®',
                    'price' => 9.99,
                ]]
        );

        $product = Product::where('name', 'CoreProduct®')->first();
        $addonProduct = Product::where('name', 'AddonCoreProduct®')->first();

        $cart = Cart::factory()->create();

        $cart->items()->createMany([
            [
                'product_id' => $product->id,
                'quantity' => 3,
                'price' => $product->price,
            ],
            [
                'product_id' => $addonProduct->id,
                'quantity' => 1,
                'price' => $addonProduct->price,
            ],
        ]);
    }
}
