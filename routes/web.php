<?php

// Route::get('login', 'UserController@login');
// Route::group(['middleware' => 'auth:api'], function()
// {
// Route::get('register', 'UserController@register');
// Route::get('/getUser', 'UserController@getUser')->name('getUser');
// Route::get('/getUserDetail','UserController@getUserDetail')->name('getUserDetail');
// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/getMessage', 'UserController@getMessage')->name('getMessage');
// Route::get('/message', 'UserController@sendMessage');

// Route::get('/chat', 'UserController@message');
// Route::get('/getMessageCounter', 'UserController@getMessageCounter');
// });

// /*==========================Client-side===============================*/

Route::get('/user_login', 'user\ClientUserController@login');
// Route::group(['middleware' => 'auth:api'], function()
// {
// Route::post('/add_post', 'user\PostController@store');
// Route::post('user_register', 'user\ClientUserController@register');
// });


// Route::get('/user_getUser', 'user\ClientUserController@getUser')->name('getUser');
// Route::get('/user_getUserDetail','user\ClientUserController@getUserDetail')->name('getUserDetail');
// Route::get('/user_home', 'user\ClientUserController@index')->name('home');
// Route::get('/user_getMessage', 'user\ClientUserController@getMessage')->name('getMessage');
// Route::get('/user_message', 'user\ClientUserController@sendMessage');

// Route::get('/user_chat', 'user\ClientUserController@message');

// Route::get('/get_post', 'user\PostController@index');