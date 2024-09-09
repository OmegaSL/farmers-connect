<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Store;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $stores = Store::pluck('id')->toArray();

        $users = User::pluck('id')->toArray();

        $products = [
            ['name' => 'Organic Tomatoes', 'category' => 'Tomatoes'],
            ['name' => 'Fresh Spinach', 'category' => 'Leafy Greens'],
            ['name' => 'Red Delicious Apples', 'category' => 'Apples'],
            ['name' => 'Russet Potatoes', 'category' => 'Root Vegetables'],
            ['name' => 'Whole Milk', 'category' => 'Milk'],
            ['name' => 'Free-Range Eggs', 'category' => 'Chicken Eggs'],
            ['name' => 'Honey Crisp Apples', 'category' => 'Apples'],
            ['name' => 'Organic Carrots', 'category' => 'Root Vegetables'],
            ['name' => 'Fresh Basil', 'category' => 'Basil'],
            ['name' => 'Grass-Fed Ground Beef', 'category' => 'Beef'],
            ['name' => 'Organic Blueberries', 'category' => 'Berries'],
            ['name' => 'Sweet Corn', 'category' => 'Corn'],
            ['name' => 'Heirloom Tomatoes', 'category' => 'Tomatoes'],
            ['name' => 'Organic Kale', 'category' => 'Leafy Greens'],
            ['name' => 'Fresh Strawberries', 'category' => 'Berries'],
            ['name' => 'Organic Cucumbers', 'category' => 'Squash'],
            ['name' => 'Raw Honey', 'category' => 'Clover Honey'],
            ['name' => 'Organic Garlic', 'category' => 'Onions'],
            ['name' => 'Fresh Cilantro', 'category' => 'Cilantro'],
            ['name' => 'Organic Avocados', 'category' => 'Tropical'],
            ['name' => 'Free-Range Chicken', 'category' => 'Chicken'],
            ['name' => 'Organic Lemons', 'category' => 'Citrus'],
            ['name' => 'Fresh Green Beans', 'category' => 'Beans'],
            ['name' => 'Organic Bell Peppers', 'category' => 'Peppers'],
            ['name' => 'Grass-Fed Ribeye Steak', 'category' => 'Beef'],
            ['name' => 'Organic Peaches', 'category' => 'Stone Fruits'],
            ['name' => 'Fresh Mint', 'category' => 'Mint'],
            ['name' => 'Organic Zucchini', 'category' => 'Squash'],
            ['name' => 'Fresh Asparagus', 'category' => 'Asparagus'],
            ['name' => 'Organic Blackberries', 'category' => 'Berries'],
            ['name' => 'Heirloom Carrots', 'category' => 'Root Vegetables'],
            ['name' => 'Organic Romaine Lettuce', 'category' => 'Leafy Greens'],
            ['name' => 'Fresh Rosemary', 'category' => 'Rosemary'],
            ['name' => 'Organic Cherry Tomatoes', 'category' => 'Tomatoes'],
            ['name' => 'Grass-Fed Lamb Chops', 'category' => 'Lamb'],
            ['name' => 'Organic Broccoli', 'category' => 'Broccoli'],
            ['name' => 'Fresh Thyme', 'category' => 'Thyme'],
            ['name' => 'Organic Sweet Potatoes', 'category' => 'Root Vegetables'],
            ['name' => 'Fresh Parsley', 'category' => 'Parsley'],
            ['name' => 'Organic Raspberries', 'category' => 'Berries'],
            ['name' => 'Heirloom Beets', 'category' => 'Root Vegetables'],
            ['name' => 'Organic Arugula', 'category' => 'Leafy Greens'],
            ['name' => 'Fresh Dill', 'category' => 'Dill'],
            ['name' => 'Organic Green Onions', 'category' => 'Onions'],
            ['name' => 'Grass-Fed Sirloin Steak', 'category' => 'Beef'],
            ['name' => 'Organic Cauliflower', 'category' => 'Cauliflower'],
            ['name' => 'Fresh Sage', 'category' => 'Sage'],
            ['name' => 'Organic Eggplant', 'category' => 'Eggplant'],
            ['name' => 'Fresh Oregano', 'category' => 'Oregano'],
            ['name' => 'Organic Plums', 'category' => 'Stone Fruits'],
            ['name' => 'Heirloom Potatoes', 'category' => 'Root Vegetables'],
            ['name' => 'Organic Lime', 'category' => 'Citrus'],
        ];

        foreach ($products as $product) {
            // Check if the category exists, if not create it
            $category = ProductCategory::firstOrCreate(
                ['name' => $product['category'], 'slug' => Str::slug($product['category'])],
            );

            DB::table('products')->insert([
                'store_id' => $stores[array_rand($stores)],
                'user_id' => $users[array_rand($users)],
                'category_id' => $category->id,
                'name' => $product['name'],
                'slug' => Str::slug($product['name']),
                'short_description' => $faker->sentence(),
                'long_description' => $faker->paragraph(),
                'base_price' => $faker->randomFloat(2, 0.50, 50.00),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Generate 100 additional products for each category
            for ($i = 0; $i < 100; $i++) {
                DB::table('products')->insert([
                    'store_id' => $stores[array_rand($stores)],
                    'user_id' => $users[array_rand($users)],
                    'category_id' => $category->id,
                    'name' => $faker->unique()->sentence(1) . ' ' . $product['category'], // Unique name for each product
                    'slug' => Str::slug($faker->unique()->sentence(1) . ' ' . $product['category']),
                    'short_description' => $faker->sentence(),
                    'long_description' => $faker->paragraph(),
                    'sale_price' => $faker->randomElement([null, $faker->randomFloat(2, 0.50, 50.00)]),
                    'base_price' => $faker->randomFloat(2, 0.50, 50.00),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->command->info('Products table seeded!');
    }
}
