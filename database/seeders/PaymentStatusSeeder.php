<?php

namespace Database\Seeders;

use App\Models\PaymentStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = ['Оплачено', 'Не оплачено'];

        collect($statuses)->each(fn($n) => PaymentStatus::query()->create(['name' => $n]));
    }
}
