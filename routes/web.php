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

Route::get('/', 'PagesController@home');
Route::get('/news', 'PagesController@news');
Route::get('/gallery', 'PagesController@gallery');
Route::get('/top', 'PagesController@top');


//ADMIN ROUTES//
Route::get('/admin', 'AdminController@index')->middleware('admin');
Route::get('/admin/news', 'AdminController@news');
Route::get('/admin/posts', 'AdminController@show');
Route::get('/admin/users', 'AdminController@users');
Route::get('/admin/create', 'AdminController@create');
Route::post('/admin/news', 'AdminController@store');
Route::delete('/admin/news/{id}', 'AdminController@destroy');
Route::get('/admin/{id}/edit', 'AdminController@edit');
Route::put('/admin/{id}/edit', 'AdminController@update');
Route::put('/userProfile/{id}', 'AdminController@ban');
Route::patch('/userProfile/{id}', 'AdminController@unban');

//USER PROFILE ROUTES//
Route::get('/userProfile/{username}', 'UserProfileController@show');
Route::get('/userPosts/{id}', 'UserProfileController@userPosts');
Route::get('/userProfile/{id}/edit', 'UserProfileController@edit')->middleware();
Route::put('/userProfile/{id}/edit', 'UserProfileController@update')->middleware();


Route::resource('posts', 'PostsController');
Route::resource('comments', 'CommentsController');

Route::get('/news/{id}', 'PagesController@show');

Auth::routes();

Route::get('/profile', 'ProfileController@index');

Route::resource('likes', 'RepliesController');
