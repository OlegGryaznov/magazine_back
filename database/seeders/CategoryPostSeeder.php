<?php

namespace Database\Seeders;

use App\Models\CategoryPost;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class CategoryPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoryPost::factory()
            ->count(10)
            ->has(Post::factory()->count(5),'posts')
            ->create();

        Tag::factory()->count(20)->create();

        Post::query()->get()->each(function ($post) {
            $tags = Tag::query()->limit(5)->inRandomOrder()->get();
            $post->tags()->sync($tags);
        });
    }
}
