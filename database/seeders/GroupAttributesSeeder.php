<?php

namespace Database\Seeders;

use App\Models\GroupAttribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupAttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['Производитель', 'Цвет'];

        foreach ($data as $item){
            GroupAttribute::query()->create([
                'name' => $item
            ]);
        }

    }
}
