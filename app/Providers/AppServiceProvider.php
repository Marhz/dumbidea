<?php

namespace App\Providers;

use App\Tag;
use App\Award;
use App\PopularTags;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);
        View::composer('tags._list', function($view) {
            $popularTags = new PopularTags();
            $tags = $popularTags->getWithScores();
            $view->with('tags', $tags);
        });
        View::composer('awards._latest', function($view) {
            $awards = Cache::remember('awards_top', 5, function() {
                $list =  Award::fetchByScore(['title', 'image'])
                    ->limit(5)
                    ->get()
                    ->map(function ($award) {
                        return (new Award((array) $award))->toCache();
                    });
                    return $list;
            })->map(function ($item) {
                return (object) $item;
            });
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
