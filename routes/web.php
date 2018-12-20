<?php


// --- LINKS --- //
Route::resource('/links', 'LinkController');
Route::get('/search', 'LinkController@search')->name('links.search');


// --- COMMENTS --- //
Route::resource('/comments', 'CommentController')->except(['index']);


// --- AUTH --- //
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::post('register', 'Auth\RegisterController@register')->name('register');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


// --- SOCIALITE --- //

Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider')->where('provider', 'twitter|github|google');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback')->where('provider', 'twitter|github|google');


// --- PROFILE --- //
Route::resource('/profiles', 'ProfileController')->only(['show']);
Route::get('/profiles/{name}/submitted', 'ProfileController@links')->name('profiles.links');


// --- UPVOTES --- //
Route::post('/links/{slug}/upvotes', 'UpvoteController@store')->name('upvotes.store');
