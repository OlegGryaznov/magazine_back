<?php

namespace Database\Seeders;

use App\Models\DeliveryStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliveryStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = ['Відвантажено', 'Не відвантажено'];

        collect($statuses)->each(fn($n) => DeliveryStatus::query()->create(['name' => $n]));
    }
}
