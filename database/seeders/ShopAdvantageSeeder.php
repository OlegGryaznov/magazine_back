<?php

namespace Database\Seeders;

use App\Models\ShopAdvantage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShopAdvantageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'text' => 'Гарантия 1 год',
                'is_active' => 1,
            ],
            [
                'text' => 'Возврат в течении 14 дней',
                'is_active' => 1,
            ],
            [
                'text' => 'Возможен наложенный платеж',
                'is_active' => 1,
            ],
            [
                'text' => 'Отправка в день заказа',
                'is_active' => 1,
            ],
        ];
        ShopAdvantage::query()->insert($data);
    }
}
