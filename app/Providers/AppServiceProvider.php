<?php

namespace App\Providers;

use App\Tag;
use App\Award;
use App\PopularTags;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\ServiceProvider;

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
            $awards = Cache::remember('awards_top', 5, function() {
                return Award::fetchByScore(['title', 'image'])
                    ->limit(5)
                    ->get()
                    ->map(function ($award) {
                        return new Award((array) $award);
                    });
            });
            // $awards = array_map('json_decode', Redis::lrange('awards_list', 0, 4));
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
