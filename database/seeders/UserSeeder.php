<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Грязнов Олег',
            'email' => 'gryaznovoleg1986@gmail.com',
            'password' => Hash::make('7578845!'),
            'phone' => '+380682727355',
            'address' => 'Офіс Президента України: вул. Банкова, 11, м. Київ',
            'address_delivery' => 'Київська обл. , Бориспільський р-н, с. Гора, вул. БОРИСПІЛЬ-7'
        ]);

        $user = User::query()
            ->where('email', 'gryaznovoleg1986@gmail.com')
            ->first();

        $user->createToken('qwerty');
    }
}
