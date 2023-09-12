<?php

namespace Database\Factories;

use App\Models\DeliveryStatus;
use App\Models\OrderStatus;
use App\Models\Payment;
use App\Models\PaymentStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::query()->inRandomOrder()->value('id'),
            'order_status_id' => OrderStatus::query()->inRandomOrder()->value('id'),
            'payment_status_id' => PaymentStatus::query()->inRandomOrder()->value('id'),
            'payment_id' => Payment::query()->inRandomOrder()->value('id'),
            'total_price' => rand(1000,9999),
            'delivery_status_id' => DeliveryStatus::query()->inRandomOrder()->value('id'),
        ];
    }
}
