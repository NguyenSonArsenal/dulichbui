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



Route::get('logout', 'Auth\LoginController@logout')->name('logout');


Route::get('/register', 'Auth\RegisterController@showFormRegister')->name('register');
Route::post('/register', 'Auth\RegisterController@create')->name('post.register');


Route::resource('users', 'UserController');

Route::post('/imagecrop', 'UserController@imageCrop');
Route::get('/imagecrop', 'UserController@index');


Route::post('/comment', 'CommentController@postComment')->name('postComment');
Route::get('/comment', 'CommentController@getComment');

