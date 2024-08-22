<?php

namespace Database\Factories;

use App\Models\Town;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $townIds = Town::pluck('id')->toArray();

        Log::info('Getting user factory data', $townIds);

        return [
            'user_id' => User::factory(),
            'town_id' => $this->faker->randomElement($townIds),
            'store_name' => $this->faker->company(),
            'address' => $this->faker->address(),
            'description' => $this->faker->paragraph(),
        ];
    }

    /**
     * Indicate that the store has no town.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withoutTown()
    {
        return $this->state(function (array $attributes) {
            return [
                'town_id' => null,
            ];
        });
    }

    /**
     * Indicate that the store has no address.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withoutAddress()
    {
        return $this->state(function (array $attributes) {
            return [
                'address' => null,
            ];
        });
    }

    /**
     * Indicate that the store has no description.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withoutDescription()
    {
        return $this->state(function (array $attributes) {
            return [
                'description' => null,
            ];
        });
    }
}
