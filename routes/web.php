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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/posts/{post}', 'HomeController@posts')->name('posts.detail');

Route::post('/send-like/{post}', 'HomeController@sendLike')->name('send.like');
Route::post('/send-dislike/{post}', 'HomeController@sendDislike')->name('send.dislike');
Route::post('/send-whatever/{post}', 'HomeController@sendWhatever')->name('send.whatever');
Route::post('/send-yourname/{post}', 'HomeController@sendYourname')->name('send.yourname');