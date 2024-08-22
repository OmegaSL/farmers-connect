<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'total_amount' => $this->faker->randomFloat(2, 10, 1000),
            'status' => $this->faker->randomElement(['pending', 'completed', 'cancelled']),
        ];
    }

    public function pending()
    {
        return $this->state(function (array $attributes) {
            return ['status' => 'pending'];
        });
    }

    public function completed()
    {
        return $this->state(function (array $attributes) {
            return ['status' => 'completed'];
        });
    }

    public function cancelled()
    {
        return $this->state(function (array $attributes) {
            return ['status' => 'cancelled'];
        });
    }
}
