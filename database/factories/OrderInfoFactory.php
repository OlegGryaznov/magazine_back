<?php

namespace Database\Factories;

use App\Models\DeliveryProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderInfo>
 */
class OrderInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_name' => fake()->name,
            'email' => fake()->email,
            'phone' => fake()->phoneNumber,
            'ttn' => mt_rand(1000000000000000,9999999999999999),
            'comment' => fake()->text('100'),
            'delivery_address' => fake()->address,
            'city' => fake()->city(),
            'provider' => DeliveryProvider::query()->inRandomOrder()->value('id'),
            'department' => fake()->address()
        ];
    }
}
