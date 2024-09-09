<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class ProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $products = Product::pluck('id')->toArray();
        $variantTypes = ['Small', 'Medium', 'Large', 'Organic', 'Non-Organic', 'Fresh', 'Frozen', 'Ripe', 'Unripe'];

        for ($i = 0; $i < 40; $i++) {
            $productId = $products[array_rand($products)];
            $variantName = $variantTypes[array_rand($variantTypes)];

            DB::table('product_variants')->insert([
                'product_id' => $productId,
                'variant_name' => $variantName,
                'price' => $faker->randomFloat(2, 0.50, 100.00),
                'stock' => $faker->numberBetween(0, 1000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Product Variants table seeded!');
    }
}
