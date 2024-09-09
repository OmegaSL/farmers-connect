<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Vegetables', 'subcategories' => ['Leafy Greens', 'Root Vegetables', 'Squash', 'Tomatoes', 'Peppers', 'Onions', 'Beans', 'Peas', 'Corn', 'Cabbage']],
            ['name' => 'Fruits', 'subcategories' => ['Berries', 'Citrus', 'Tropical', 'Stone Fruits', 'Apples', 'Melons', 'Grapes', 'Pears', 'Figs', 'Exotic Fruits']],
            ['name' => 'Grains', 'subcategories' => ['Wheat', 'Rice', 'Oats', 'Barley', 'Corn', 'Quinoa', 'Millet', 'Rye', 'Sorghum', 'Buckwheat']],
            ['name' => 'Dairy', 'subcategories' => ['Milk', 'Cheese', 'Yogurt', 'Butter', 'Cream', 'Ice Cream', 'Kefir', 'Ghee', 'Cottage Cheese', 'Whey']],
            ['name' => 'Meat', 'subcategories' => ['Beef', 'Pork', 'Chicken', 'Lamb', 'Goat', 'Turkey', 'Duck', 'Rabbit', 'Venison', 'Bison']],
            ['name' => 'Eggs', 'subcategories' => ['Chicken Eggs', 'Duck Eggs', 'Quail Eggs', 'Goose Eggs', 'Turkey Eggs', 'Ostrich Eggs', 'Emu Eggs', 'Bantam Eggs', 'Guinea Fowl Eggs', 'Pheasant Eggs']],
            ['name' => 'Herbs', 'subcategories' => ['Basil', 'Parsley', 'Cilantro', 'Mint', 'Rosemary', 'Thyme', 'Sage', 'Dill', 'Oregano', 'Chives']],
            ['name' => 'Nuts', 'subcategories' => ['Almonds', 'Walnuts', 'Pecans', 'Cashews', 'Pistachios', 'Hazelnuts', 'Macadamia', 'Brazil Nuts', 'Pine Nuts', 'Chestnuts']],
            ['name' => 'Seeds', 'subcategories' => ['Sunflower Seeds', 'Pumpkin Seeds', 'Chia Seeds', 'Flax Seeds', 'Sesame Seeds', 'Hemp Seeds', 'Poppy Seeds', 'Quinoa Seeds', 'Amaranth Seeds', 'Fennel Seeds']],
            ['name' => 'Honey', 'subcategories' => ['Clover Honey', 'Manuka Honey', 'Acacia Honey', 'Wildflower Honey', 'Buckwheat Honey', 'Orange Blossom Honey', 'Sage Honey', 'Tupelo Honey', 'Eucalyptus Honey', 'Lavender Honey']],
            ['name' => 'Mushrooms', 'subcategories' => ['Button Mushrooms', 'Shiitake', 'Portobello', 'Oyster Mushrooms', 'Chanterelle', 'Porcini', 'Enoki', 'Morel', 'Truffle', 'Lion\'s Mane']],
            ['name' => 'Flowers', 'subcategories' => ['Edible Flowers', 'Cut Flowers', 'Dried Flowers', 'Potted Plants', 'Flower Seeds', 'Bouquets', 'Flower Bulbs', 'Wildflowers', 'Ornamental Grasses', 'Succulents']],
            ['name' => 'Spices', 'subcategories' => ['Cinnamon', 'Turmeric', 'Ginger', 'Cumin', 'Coriander', 'Paprika', 'Black Pepper', 'Cardamom', 'Cloves', 'Nutmeg']],
            ['name' => 'Legumes', 'subcategories' => ['Lentils', 'Chickpeas', 'Black Beans', 'Kidney Beans', 'Pinto Beans', 'Navy Beans', 'Lima Beans', 'Soybeans', 'Mung Beans', 'Fava Beans']],
            ['name' => 'Oils', 'subcategories' => ['Olive Oil', 'Coconut Oil', 'Sunflower Oil', 'Avocado Oil', 'Grapeseed Oil', 'Walnut Oil', 'Flaxseed Oil', 'Pumpkin Seed Oil', 'Sesame Oil', 'Hemp Seed Oil']],
            ['name' => 'Vinegars', 'subcategories' => ['Apple Cider Vinegar', 'Balsamic Vinegar', 'Red Wine Vinegar', 'White Wine Vinegar', 'Rice Vinegar', 'Sherry Vinegar', 'Malt Vinegar', 'Champagne Vinegar', 'Fruit Vinegars', 'Herb-Infused Vinegars']],
            ['name' => 'Syrups', 'subcategories' => ['Maple Syrup', 'Agave Syrup', 'Corn Syrup', 'Date Syrup', 'Molasses', 'Rice Syrup', 'Barley Malt Syrup', 'Fruit Syrups', 'Herb-Infused Syrups', 'Flavored Simple Syrups']],
            ['name' => 'Jams and Preserves', 'subcategories' => ['Strawberry Jam', 'Raspberry Preserves', 'Apricot Jam', 'Blueberry Preserves', 'Peach Jam', 'Marmalade', 'Cherry Preserves', 'Fig Jam', 'Blackberry Preserves', 'Plum Jam']],
            ['name' => 'Fermented Foods', 'subcategories' => ['Sauerkraut', 'Kimchi', 'Kombucha', 'Pickles', 'Miso', 'Tempeh', 'Kefir', 'Sourdough', 'Natto', 'Fermented Hot Sauce']],
            ['name' => 'Farm Equipment', 'subcategories' => ['Hand Tools', 'Irrigation Supplies', 'Seed Starting Supplies', 'Harvesting Tools', 'Pest Control Products', 'Fertilizers', 'Soil Amendments', 'Packaging Materials', 'Farm Apparel', 'Farm Safety Equipment']]
        ];

        $uniqueCategories = [];
        foreach ($categories as $category) {
            $found = false;
            foreach ($uniqueCategories as $uniqueCategory) {
                if ($category['name'] == $uniqueCategory['name'] && $category['subcategories'] == $uniqueCategory['subcategories']) {
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $uniqueCategories[] = $category;
            }
        }

        foreach ($uniqueCategories as $category) {
            $parentId = DB::table('product_categories')->insertGetId([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($category['subcategories'] as $subcategory) {
                $existingSubcategory = DB::table('product_categories')->where('name', $subcategory)->first();
                if ($existingSubcategory) {
                    continue;
                }

                DB::table('product_categories')->insert([
                    'name' => $subcategory,
                    'slug' => Str::slug($subcategory),
                    'parent_id' => $parentId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->command->info('Product categories seeded successfully.');
    }
}
