<?php

Route::get('login', 'UserController@login');
Route::group(['middleware' => 'auth:api'], function()
{

   Route::get('details', 'UserController@details');
   //Route::post('message', 'HomeController@sendMessage');
});

Route::get('register', 'UserController@register');
Route::get('/getUser', 'UserController@getUser')->name('getUser');
Route::get('/getUserDetail','UserController@getUserDetail')->name('getUserDetail');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/getMessage', 'UserController@getMessage')->name('getMessage');
Route::get('/message', 'UserController@sendMessage');

Route::get('/chat', 'UserController@message');
Route::get('/getMessageCounter', 'UserController@getMessageCounter');
