<?php

namespace Database\Seeders;

use App\Models\Label;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Топ продаж',
                'mark' => 'best'
            ],
            [
                'name' => 'Акция',
                'mark' => 'sale'
            ],
            [
                'name' => 'Расспродажа',
                'mark' => 'sale'
            ],
            [
                'name' => '-30%',
                'mark' => 'hot'
            ],
            [
                'name' => 'Новинка',
                'mark' => 'new'
            ],
        ];

        Label::query()->insert($data);
    }
}
