<?php

namespace Database\Seeders;

use App\Models\Coupon;
use App\Models\User;
use App\Models\Store;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Promotion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RegionDistrictTownSeeder::class,
            ProductCategorySeeder::class,
            ProductSeeder::class,
            ProductVariantSeeder::class,
            OrderWithItemsSeeder::class,
            ReviewSeeder::class,
        ]);

        // Promotion::factory(5)->create();
        // Create a percentage-based promotion
        Promotion::factory(2)->percentage()->create();

        // Create an active, fixed-amount promotion
        Promotion::factory(2)->fixedAmount()->active()->create();

        // Create a future, inactive promotion
        Promotion::factory(3)->future()->inactive()->create();

        // Coupon::factory(5)->create();
        // Create a percentage-based coupon
        Coupon::factory(2)->percentage()->create();

        // Create an active, fixed-amount coupon with usage limit
        Coupon::factory(2)->fixedAmount()->active()->withUsageLimit()->create();

        // Create a future, inactive coupon
        Coupon::factory(3)->future()->inactive()->create();
    }
}
