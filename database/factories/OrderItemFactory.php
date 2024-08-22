<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productVariant = ProductVariant::inRandomOrder()->first();

        return [
            'order_id' => Order::factory(),
            'product_variant_id' => $productVariant->id,
            'quantity' => $this->faker->numberBetween(1, 5),
            'price' => $productVariant->price,
        ];
    }
}
