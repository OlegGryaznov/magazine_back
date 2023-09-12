<?php

namespace Database\Seeders;

use App\Models\Social;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'link' => 'http://facebook.com',
                'name' => 'Facebook',
                'class' => 'facebook',
                'icon' => 'fab fa-facebook-f'
            ],
            [
                'link' => 'https://twitter.com',
                'name' => 'Twitter',
                'class' => 'twitter',
                'icon' => 'fab fa-twitter'
            ],
            [
                'link' => 'https://tumblr.com',
                'name' => 'Tumblr',
                'class' => 'tumblr',
                'icon' => 'fab fa-tumblr'
            ],
            [
                'link' => 'https://instagram.com',
                'name' => 'Instagram',
                'class' => 'instagram',
                'icon' => 'fab fa-instagram'
            ],
        ];

       Social::query()->insert($data);

    }
}
