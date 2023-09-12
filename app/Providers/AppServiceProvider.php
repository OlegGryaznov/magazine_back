<?php

namespace App\Providers;

use App\Http\Controllers\Api\V1\Front\Auth\SocialAuthController;
use App\Libs\External\NewPost\NewPost;
use App\Libs\External\NewPost\Contracts\NewPostContract;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Widget;
use App\Socialite\SocialiteManagerCustom;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Contracts\Factory;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }

        $this->app->when(SocialAuthController::class)
            ->needs(Factory::class)
            ->give(function () {
                return new SocialiteManagerCustom($this->app);
            });

        $this->app->singleton(NewPostContract::class, function($app) {
            return new NewPost(config('post.new_post'));
        });

        $this->app->alias(NewPostContract::class, 'new-post');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::enforceMorphMap([
            'category' => Category::class,
            'product' => Product::class,
            'widget' => Widget::class,
            'user' => User::class
        ]);

        Carbon::setLocale('uk');
    }
}
