<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Promotion>
 */
class PromotionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $promotionNames = [
            'Summer Sale',
            'Winter Clearance',
            'Back to School',
            'Black Friday Deal',
            'Cyber Monday Special',
            'Holiday Savings',
            'Flash Sale',
            'Weekend Special',
            'New Year Discount',
            'Spring Fling',
            'Fall Harvest Sale',
            'Customer Appreciation',
            'First-Time Buyer Discount',
            'Loyalty Reward',
            'Buy One Get One Free',
            'End of Season Clearance',
            'Limited Time Offer',
            'Members Only Deal',
            'Early Bird Special',
            'Last Chance Sale'
        ];

        $startDate = $this->faker->dateTimeBetween('now', '+1 month');
        $endDate = $this->faker->dateTimeBetween($startDate, '+3 months');

        return [
            'name' => $this->faker->randomElement($promotionNames),
            'description' => $this->faker->paragraph,
            'discount_type' => $this->faker->randomElement(['percentage', 'fixed_amount']),
            'discount_value' => $this->faker->randomFloat(2, 5, 50),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'active' => $this->faker->boolean(80), // 80% chance of being active
        ];
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
