<?php


// --- LINKS --- //
Route::resource('/links', 'LinkController');
Route::get('/search', 'LinkController@search')->name('links.search');


// --- COMMENTS --- //
Route::resource('/comments', 'CommentController')->except(['index']);


// --- AUTH --- //
Auth::routes();


// --- PROFILE --- //
Route::resource('/profile', 'ProfileController')->only(['show']);
Route::get('/submitted/{name}/links', [
    'as' => 'profile.links',
    'uses' => 'ProfileController@links'
]);


// --- UPVOTES --- //
Route::post('/upvotes', 'UpvoteController@store')->name('upvotes.store');
