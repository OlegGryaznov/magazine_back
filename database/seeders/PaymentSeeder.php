<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payments = ['Картой банка', 'Рассчетный счет', "Наложенный платеж"];

        collect($payments)->each(fn($method) => Payment::query()->create(['name' => $method]));
    }
}
