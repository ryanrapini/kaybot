<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PageController@showHome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/actions/tweet', 'HomeController@sendTweet');

Route::get('live-tweets', 'HomeController@getLiveTweets');

Route::post('generated-tweets/store-many', 'GeneratedTweetController@storeMany');
Route::resource('generated-tweets', 'GeneratedTweetController');
