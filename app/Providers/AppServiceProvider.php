<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Tag;
use Illuminate\Support\Facades\View;
use App\Award;
use Illuminate\Support\Facades\Redis;
use App\PopularTags;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('tags._list', function($view) {
            $popularTags = new PopularTags();
            $tags = $popularTags->getWithScores();
            $view->with('tags', $tags);
        });
        View::composer('awards._latest', function($view) {
            $awards = array_map('json_decode', Redis::lrange('awards_list', 0, 4));
            $view->with('awards', $awards);
        });
        View::composer('awards._trending', function ($view) {
            $trending = new \App\Trending();
            $awards = $trending->get();
            $view->with('awards', $awards);
        });
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
