<?php


// --- LINKS --- //

Route::resource('/links', 'LinkController')->only([
    'index', 'create', 'store', 'show', 'destroy',
]);
Route::get('/search', 'LinkController@search')->name('links.search');


// --- COMMENTS --- //
Route::resource('/comments', 'CommentController')->only(['store']);
Route::post('/reply', 'CommentController@replyStore')->name('reply.store');


// --- AUTH --- //

Route::get('login', [
  'as' => 'login',
  'uses' => 'Auth\LoginController@showLoginForm'
]);
Route::post('login', [
  'as' => '',
  'uses' => 'Auth\LoginController@login'
]);
Route::post('logout', [
  'as' => 'logout',
  'uses' => 'Auth\LoginController@logout'
]);

// Password Reset Routes...
Route::post('password/email', [
  'as' => 'password.email',
  'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail'
]);
Route::get('password/reset', [
  'as' => 'password.request',
  'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm'
]);
Route::post('password/reset', [
  'as' => '',
  'uses' => 'Auth\ResetPasswordController@reset'
]);
Route::get('password/reset/{token}', [
  'as' => 'password.reset',
  'uses' => 'Auth\ResetPasswordController@showResetForm'
]);

// Registration Routes...
Route::get('register', [
  'as' => 'register',
  'uses' => 'Auth\RegisterController@showRegistrationForm'
]);
Route::post('register', [
  'as' => '',
  'uses' => 'Auth\RegisterController@register'
]);


// --- PROFILE --- //

Route::resource('/profile', 'ProfileController')->only(['show']);
Route::get('/submitted/{name}/links', [
    'as' => 'profile.links',
    'uses' => 'ProfileController@links'
]);


// --- UPVOTES --- //
Route::post('/upvotes', 'UpvoteController@store')->name('upvotes.store');
