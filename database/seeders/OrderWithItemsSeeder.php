<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Faker\Factory as Faker;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderWithItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create 50 orders
        User::all()->each(function ($user) {
            $this->createOrderForUser($user);
        });

        $this->command->info('Orders table seeded!');
    }

    private function createOrderForUser($user)
    {
        $faker = Faker::create();

        $order = Order::create([
            'user_id' => $user->id,
            'total_amount' => 0, // We'll calculate this later
            'status' => $this->getRandomStatus(),
        ]);

        $orderItems = $this->createOrderItems($order);

        // Calculate and update the total amount
        $totalAmount = $orderItems->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        $order->update(['total_amount' => $totalAmount]);

        // add transaction record for the order
        Transaction::create([
            'user_id' => $order->user_id,
            'transaction_id' => uniqid(),
            'order_id' => $order->id,
            'amount' => $order->total_amount,
            'currency' => '₵',
            'payment_method' => 'mobile_money',
            'account_number' => $faker->creditCardNumber,
            'payment_reference' => $faker->randomElement(['payment_ref_1', 'payment_ref_2']),
            'payment_status' => $faker->randomElement(['pending', 'success', 'failed']),
        ]);
    }

    private function createOrderItems($order)
    {
        $itemCount = rand(1, 5); // Random number of items per order
        $orderItems = collect();

        for ($i = 0; $i < $itemCount; $i++) {
            $productVariant = ProductVariant::inRandomOrder()->first();

            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productVariant->product->id ?? null,
                'product_variant_id' => $productVariant->id,
                'quantity' => rand(1, 5),
                'price' => $productVariant->price,
            ]);

            $orderItems->push($orderItem);
        }

        return $orderItems;
    }

    private function getRandomStatus()
    {
        $statuses = ['pending', 'completed', 'cancelled'];
        return $statuses[array_rand($statuses)];
    }
}
