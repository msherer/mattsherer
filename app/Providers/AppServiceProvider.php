<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Post;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        if (Schema::hasTable('posts')) {
            $popularPosts = Post::latest()->limit(3)->get();

            $latestPosts = Post::latest()->limit(6)->get();

            view()->share([
                'latestPosts' => $latestPosts,
                'popularPosts' => $popularPosts
            ]);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
