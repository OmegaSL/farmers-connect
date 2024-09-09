<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Review;
use App\Models\Product;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // generate random reviews
        $faker = Faker::create();

        $users = User::pluck('id')->toArray();

        $products = Product::where('status', 'published')->pluck('id')->toArray();

        for ($i = 0; $i < 1000; $i++) {
            $review = new Review();
            $review->product_id = $faker->randomElement($products);
            $review->user_id = $faker->randomElement($users);
            $review->rating = $faker->numberBetween(1, 5);
            $review->comment = $faker->sentence();
            $review->save();
        }

        $this->command->info('Reviews table seeded!');
    }
}
