<?php

namespace Database\Seeders;

use App\Models\DeliveryProvider;
use App\Models\Order;
use App\Models\OrderInfo;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $products = Product::inRandomOrder()->take(100)->get() ?? Product::factory(100)->create();

        $orders = Order::factory(40)
            ->has(OrderInfo::factory(), 'info')
            ->create();

        $randomProviders = DeliveryProvider::query()->get()->random();

        $orders->each(function ($order) use ($products, $randomProviders){

           $randomProducts = $products->random(mt_rand(1, 20));

           $order->providers()->attach($randomProviders->id);

           $randomProducts->each(function ($product) use ($order) {
                $order->products()->attach(
                    $product->id,
                    [
                        'amount' => $amount = mt_rand(1,10),
                        'price' => $product->price
                    ]
                );
           });
        });






    }
}
