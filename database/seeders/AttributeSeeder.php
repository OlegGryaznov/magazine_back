<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Статус-М',
                'group_id' => 1,
            ],
            [
                'name' => 'Омега',
                'group_id' => 1,
            ],

            [
                'name' => 'Серый',
                'group_id' => 2,
            ],
            [
                'name' => 'Черный',
                'group_id' => 2,
            ],
            [
                'name' => 'Белый',
                'group_id' => 2,
            ],
        ];

        Attribute::query()->insert($data);
    }
}
