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
Route::post('awards/{award}/upvote', 'VoteController@upvote');
Route::post('awards/{award}/downvote', 'VoteController@downvote');
Route::get('/tags/{tag}', 'TagController@show')->name('tag.show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

