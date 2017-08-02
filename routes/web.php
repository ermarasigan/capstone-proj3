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

Route::get('/', 'BlogController@showBlogs');

Route::get('/tag/{id}', 'TagController@showBlogs');

Route::group(['middleware' => ['web']], function(){
	Route::post('/removeTag', 'BlogController@removeTag');
});
Auth::routes();

Route::post('/newBlog', 'BlogController@newBlog');

Route::post('/deleteBlog', 'BlogController@deleteBlog');

Route::post('/editBlog', 'BlogController@editBlog');

Route::post('/addTag', 'BlogController@addTag');

// Route::get('/home', 'HomeController@index')->name('home');
