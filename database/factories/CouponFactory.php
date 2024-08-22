<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('now', '+1 month');
        $endDate = $this->faker->dateTimeBetween($startDate, '+3 months');

        return [
            'code' => $this->generateUniqueCode(),
            'description' => $this->faker->sentence(),
            'discount_type' => $this->faker->randomElement(['percentage', 'fixed_amount']),
            'discount_value' => $this->faker->randomFloat(2, 5, 50),
            'usage_limit' => $this->faker->optional()->numberBetween(1, 1000),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'active' => $this->faker->boolean(80), // 80% chance of being active
        ];
    }

    protected function generateUniqueCode()
    {
        return strtoupper($this->faker->bothify('????##'));
    }

    public function percentage()
    {
        return $this->state(function (array $attributes) {
            return [
                'discount_type' => 'percentage',
                'discount_value' => $this->faker->numberBetween(5, 50),
            ];
        });
    }

    public function fixedAmount()
    {
        return $this->state(function (array $attributes) {
            return [
                'discount_type' => 'fixed_amount',
                'discount_value' => $this->faker->randomFloat(2, 5, 100),
            ];
        });
    }

    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'active' => true,
            ];
        });
    }

    public function inactive()
    {
        return $this->state(function (array $attributes) {
            return [
                'active' => false,
            ];
        });
    }

    public function withUsageLimit()
    {
        return $this->state(function (array $attributes) {
            return [
                'usage_limit' => $this->faker->numberBetween(1, 1000),
            ];
        });
    }

    public function future()
    {
        return $this->state(function (array $attributes) {
            $startDate = $this->faker->dateTimeBetween('+1 week', '+1 month');
            $endDate = $this->faker->dateTimeBetween($startDate, '+3 months');
            return [
                'start_date' => $startDate,
                'end_date' => $endDate,
            ];
        });
    }
}
