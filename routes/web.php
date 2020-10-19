<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('post/write', 'PostController@write')->name('posts.write');
Route::post('post/search', 'PostController@search')->name('posts.search');
Route::resource('posts', 'PostController');

Route::resource('users', 'UserController');

Route::group(['middleware' => 'auth'], function() {
    Route::resource('rooms', 'RoomController');
    Route::get('/ajax/message/{room}', 'Ajax\MessageController@index');
    Route::post('/ajax/message', 'Ajax\MessageController@create');
    Route::post('add_bookmark/{post}', 'BookmarkController@store')->name('add_bookmark');
    Route::post('take_bookmark/{post}', 'BookmarkController@destroy')->name('take_bookmark');
    Route::get('bookmark/{user}', 'BookmarkController@index')->name('bookmarks');
    Route::get('mypage', 'UserController@mypage')->name('mypage');
});