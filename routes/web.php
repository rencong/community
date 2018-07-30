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

Route::get('/', 'PostController@index')->name('discussion.index');
Route::get('/discussion/create', 'PostController@create')->name('discussion.create');
Route::get('/discussion/edit/{id}', 'PostController@edit')->name('discussion.edit');
Route::post('/discussion/create', 'PostController@store')->name('discussion.store');
Route::post('/discussion/update', 'PostController@update')->name('discussion.update');
Route::get('/discussion/{id}', 'PostController@show')->name('discussion.show');

Route::get('/comment/create', 'CommentController@create')->name('comment.create');
Route::post('/comment/create', 'CommentController@store')->name('comment.store');

Route::get('/user/register', 'UserController@register')->name('user.register');
Route::get('/user/login', 'UserController@login')->name('login');
Route::get('/user/avatar', 'UserController@avatar')->name('user.avatar');
Route::post('/crop/avatar', 'UserController@cropAvatar')->name('crop.avatar');//裁剪头像
Route::post('/user/avatar', 'UserController@changeAvatar')->name('user.change.avatar');//更新头像
Route::get('/logout', 'UserController@logout')->name('user.logout');
Route::get('/verify/{confirm_code}', 'UserController@confirmEmail')->name('verify.email');
Route::post('/user/register', 'UserController@store')->name('user.register.post');
Route::post('/user/login', 'UserController@signin')->name('user.login.post');
Route::post('/post/upload', 'PostController@upload')->name('post.upload');
