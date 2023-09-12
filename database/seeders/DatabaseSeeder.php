<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\DeliveryProvider;
use App\Models\GroupAttribute;
use App\Models\Tag;
use Database\Factories\TagFactory;
use Illuminate\Database\Seeder;
use NunoMaduro\Collision\Provider;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PaymentSeeder::class);
        $this->call(OrderStatusSeeder::class);
        $this->call(PaymentStatusSeeder::class);
        $this->call(DeliveryStatusSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ShopAdvantageSeeder::class);
        $this->call(LabelSeeder::class);
        $this->call(GroupAttributesSeeder::class);
        $this->call(AttributeSeeder::class);
        $this->call(CategoryPostSeeder::class);
        $this->call(SocialSeeder::class);
        $this->call(DeliveryProvidersSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(WidgetSeeder::class);
        $this->call(OrderSeeder::class);
    }
}
