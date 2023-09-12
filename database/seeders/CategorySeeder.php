<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\GroupAttribute;
use App\Models\Label;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = File::files(public_path('product-images'));

        Category::factory(12)
            ->has(Product::factory()->count(50),'products')
            ->create();

        $products = Product::query()->get();
        $groupAttributes = GroupAttribute::query()->with('attributes')->get();
        $labels = Label::query()->exists();

        if(!$labels) {
            $this->call(LabelSeeder::class);
        }

        $labels = Label::query()->get();

        foreach ($products as $product) {

            $randomLabels = $labels->random(2)->pluck('id')->toArray();
            $product->labels()->attach($randomLabels);

            $product
                ->addMedia($images[mt_rand(0, count($images)-1)])
                ->preservingOriginal()
                ->toMediaCollection();

            $product
                ->addMedia($images[mt_rand(0, count($images)-1)])
                ->preservingOriginal()
                ->toMediaCollection();

            foreach ($groupAttributes as $groupAttribute){
                $product->attributes()->attach($groupAttribute->attributes->random());
            }

        }
    }
}
