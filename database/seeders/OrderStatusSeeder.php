<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            'Новий',
            'Виконаний',
            'В очікуванні',
            'Відмінено'
        ];

        collect($statuses)->each(fn($name) => OrderStatus::query()->create(['name' => $name]));
    }
}
