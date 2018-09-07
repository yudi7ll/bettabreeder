<?php

Route::get('/', function () {
    return redirect('auction');
});

Auth::routes();

Route::group(['middleware' => 'lastActivity'], function(){ // Tracking Users Activity

    // Auctions
    Route::prefix('auction')->name('auction.')->group(function(){
        // Auction Image
        Route::post('/image/{id}', 'AuctionController@imageUploadStore')->name('image.store');
        Route::get('/image', 'AuctionController@imageUpload')->name('image');
         // Add Comment
        Route::post('/auction/comment/{auctions_id}', 'CommentsController@addComment')->name('comment');
    });
    Route::resource('/auction', 'AuctionController');
    
    // Articles
    Route::get('/articles', 'ArticlesController@index')->name('articles');
    
    // admin route
    Route::get('/admin', 'AdminController@index')->name('admin');
    
    // Profile
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::name('profile.')->prefix('profile')->group(function(){
        Route::get('/edit', 'ProfileController@edit')->name('edit');
        Route::put('/update', 'ProfileController@update')->name('update');
        Route::post('/cover', 'ProfileController@cover')->name('cover');
        Route::get('/cover/fail', 'ProfileController@error')->name('fail'); // when cover update error
    });
    
    // bid
    Route::post('/bid/{auctions_id}', 'BidController@store')->name('bid');
});
