<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::get('/user_login', 'user\ClientUserController@login');

Route::get('login', 'UserController@login');
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('register', 'UserController@register');
    Route::get('/getUser', 'UserController@getUser')->name('getUser');
    Route::get('/getUserDetail', 'UserController@getUserDetail')->name('getUserDetail');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/getMessage', 'UserController@getMessage')->name('getMessage');
    Route::get('/message', 'UserController@sendMessage');

    Route::get('/chat', 'UserController@message');
    Route::get('/getMessageCounter', 'UserController@getMessageCounter');
});



// Route::group(['middleware' => 'auth:api'], function()
// {

Route::get('/user_login', 'user\ClientUserController@login');
Route::post('add_post', 'user\PostController@store')->name('add_post');
Route::post('/user_register', 'user\ClientUserController@register')->name('user_register');
Route::get('/user_getUser', 'user\ClientUserController@getUser')->name('getUser');
Route::get('/user_getUserDetail', 'user\ClientUserController@getUserDetail')->name('getUserDetail');
Route::get('/user_home', 'user\ClientUserController@index')->name('home');
Route::get('/user_getMessage', 'user\ClientUserController@getMessage')->name('getMessage');
Route::get('/user_message', 'user\ClientUserController@sendMessage');
Route::get('/user_chat', 'user\ClientUserController@message');
Route::get('/get_post', 'user\PostController@index');


/*=========================User Edits=====================================*/
Route::get('/getOneUser/{id}', 'user\ClientUserController@getOneUser');
Route::get('/updateUser/{id}', 'user\ClientUserController@updateUser');
// Route::get('/get_post', 'user\PostController@index');


/*=========================Posts=====================================*/
Route::get('/deletePost/{id}', 'user\PostController@deletePost');

/*=========================Comments=====================================*/
Route::get('/add_comment', 'user\CommentController@store');
Route::get('/get_comment', 'user\CommentController@getComment');
Route::get('/count_comment', 'user\CommentController@getCommentCount');

/*=========================Likes=====================================*/
Route::get('/add_like', 'user\LikeController@store');
Route::get('/del_like', 'user\LikeController@delete');

/*=========================Share=====================================*/
Route::get('/share', 'user\ShareController@store');

/*=========================Profile=====================================*/
Route::get('/profile', 'user\ProfileController@profile');

/*=========================Form Validation=====================================*/
Route::get('/validate-first', 'user\FormValidationController@firstForm');
Route::post('/validate-second', 'user\FormValidationController@secondForm');
Route::post('/validate-fourth', 'user\FormValidationController@fourthForm');

/*=========================Like =====================================*/
Route::get('/profile-like', 'user\ProfileController@likeStore');
Route::get('/profile-love', 'user\ProfileController@loveStore');
Route::get('/profile-s_love', 'user\ProfileController@superLoveStore');
Route::get('/profile-visited', 'user\ProfileController@visitedStore');

/*=========================Hobby And AboutMe  =====================================*/

Route::get('/aboutMe/{id}', 'user\ClientUserController@addAboutMe');
Route::get('/hobby/{id}', 'user\ClientUserController@addHobby');

/*=========================Matching================================*/
Route::get('/exprore', 'user\ProfileController@exprore');

/*=========================Reports=====================================*/
Route::get('/addReport', 'reportsController@create');


// });
