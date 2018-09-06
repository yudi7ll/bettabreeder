<?php

Route::get('/', function () {
    return redirect('home');
});

Auth::routes();

Route::group(['middleware' => 'lastActivity'], function(){ // Tracking Users Activity

    Route::get('/home', 'HomeController@index')->name('home');

    // Auctions
    Route::resource('/auction', 'AuctionController');
    // Add Comment
    Route::post('/auction/comment/{auctions_id}', 'CommentsController@addComment')->name('auction.comment');
    
    // Articles
    Route::get('/articles', 'ArticlesController@index')->name('articles');
    
    // admin route
    Route::get('/admin', 'AdminController@index')->name('admin');
    
    // profile
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
    Route::put('/profile/update', 'ProfileController@update')->name('profile.update');
    Route::post('/profile/cover', 'ProfileController@cover')->name('profile.cover');
    Route::get('/profile/cover/fail', 'ProfileController@error')->name('profile.fail'); // when cover update error
    
    // bid
    Route::post('/bid/{auctions_id}', 'BidController@store')->name('bid');
});
