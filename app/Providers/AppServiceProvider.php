<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Tag;
use Illuminate\Support\Facades\View;
use App\Award;

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
            $tags = Tag::withCount('awards')->orderBy('awards_count', 'desc')->take(6)->get();
            $view->with('tags', $tags);
        });

        View::composer('awards._latest', function($view) {
            $awards = Award::latest()->take(5)->get();
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
