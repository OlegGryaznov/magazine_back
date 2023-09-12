<?php

namespace Database\Seeders;

use App\Models\DeliveryProvider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliveryProvidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Нова Пошта',
                'is_active' => DeliveryProvider::IS_ACTIVE
            ],
            [
                'name' => 'Укрпошта',
                'is_active' => DeliveryProvider::IS_ACTIVE
            ],
            [
                'name' => "Доставка кур'єром",
                'is_active' => DeliveryProvider::IS_ACTIVE
            ],
            [
                'name' => 'Самовивіз',
                'is_active' => DeliveryProvider::IS_ACTIVE
            ],
        ];

        DeliveryProvider::query()->insert($data);
    }
}
