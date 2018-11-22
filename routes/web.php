<?php


// --- LINKS --- //
Route::resource('/links', 'LinkController');
Route::get('/search', 'LinkController@search')->name('links.search');


// --- COMMENTS --- //
Route::resource('/comments', 'CommentController')->except(['index']);


// --- AUTH --- //
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::post('register', 'Auth\RegisterController@register');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


// --- PROFILE --- //
Route::resource('/profile', 'ProfileController')->only(['show']);
Route::get('/submitted/{name}/links', [
    'as' => 'profile.links',
    'uses' => 'ProfileController@links'
]);


// --- UPVOTES --- //
Route::post('/upvotes', 'UpvoteController@store')->name('upvotes.store');
