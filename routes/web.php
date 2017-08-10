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

Route::get('/', 'HomeController@index')->name('index');

Auth::routes();

Route::get('/login', function () {
	return view('auth.login');
})->name('login');



// Auth user
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/register', 'Auth\RegisterController@showFormRegister')->name('register');
Route::post('/register', 'Auth\RegisterController@create')->name('post.register');


//User
Route::resource('users', 'UserController');


// Trip
Route::resource('trips', 'TripController');
Route::post('trips/update-cover','TripController@updateCover')->name('postToUpdateCoverTrip');
Route::post('trips/join-trip','TripController@joinTrip')->name('postToJoinTrip');

Route::post('trips/cancel-or-accept-user-join-trip','TripController@acceptOrCancelUserJoinTrip')->name('postToCancelOrAcceptUserJoinTrip');


// Update avatar user
Route::post('/imagecrop', 'UserController@imageCrop');
Route::get('/imagecrop', 'UserController@index');



Route::group(["prefix"=>"comment"], function () {

    Route::post('/', 'CommentController@postToAddComment')->name('postToAddComment');
 
   	//Route::get('/', 'CommentController@getComment');

   	Route::post('/delete/{id}', 'CommentController@postToDeleteComment')->name('postToDeleteComment');
   	//Route::post('/delete/{sub_id}', 'CommentController@postToDeleteSubComment')->name('postToDeleteSubComment');

});

