<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'AwardController@index');

Route::resource('awards', 'AwardController');
Route::post('{model}/{award}/upvote', 'VoteController@upvote')
    ->where('model', 'awards|comments')
    ->name('upvote');
Route::post('{model}/{id}/downvote', 'VoteController@downvote')
    ->where('model', 'awards|comments')
    ->name('downvote');
Route::get('/tags/{tag}', 'TagController@show')->name('tag.show');
Route::get('api/awards/{award}/comments', 'CommentController@index');
Route::post('api/awards/{award}/comments', 'CommentController@store')->name('comments.post');
Route::patch('api/comments/{comment}/edit', 'CommentController@update')->name('comments.update');
Route::delete('api/comments/{comment}/delete', 'CommentController@destroy')->name('comments.destroy');

Route::get('profile/{user?}', 'ProfileController@show')->name('profile.show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('auth/facebook', 'Auth\FacebookLoginController@redirectToProvider')->name('auth.facebook');
Route::get('auth/facebook/callback', 'Auth\FacebookLoginController@handleCallback');

Route::get('auth/twitter', 'Auth\TwitterLoginController@redirectToProvider')->name('auth.twitter');
Route::get('auth/twitter/callback', 'Auth\TwitterLoginController@handleCallback');

Route::get('user-policy', function() {
    return '<h1>LOL</h1>';
});

Route::get('test', function() {
    
    dump(App\Award::fetchByScore(['title'])->map(function($m) { 
        // dump($m->path);
    }));
    return view('welcome');
});
