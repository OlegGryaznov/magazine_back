<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Widget;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class WidgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = File::files(public_path('product-images'));

        $widgetsFromBase = Widget::query()->get();

        if($widgetsFromBase->isEmpty()) {
            $widgets = Widget::factory()->count(4)->create();
        }

        $widgets->each(function ($widget) use ($images) {
            $widget
                ->addMedia($images[mt_rand(0, count($images) - 1)])
                ->preservingOriginal()
                ->toMediaCollection();

            $widget->categories()->attach(Category::query()->inRandomOrder()->take(3)->pluck('id'));
        });


    }
}
