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

Route::get('/', function () {
    return redirect('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/auction', 'AuctionController');

Route::get('/articles', 'ArticlesController@index')->name('articles');

// admin route
Route::get('/admin', 'AdminController@index')->name('admin');

// profile
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
Route::put('/profile/update', 'ProfileController@update')->name('profile.update');
Route::post('/profile/cover', 'ProfileController@cover')->name('profile.cover');

// bid
Route::put('/bid', 'BidController@store')->name('bid');
