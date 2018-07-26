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

Route::get('/', 'PostsController@index')->name('discussion.index');
Route::get('/discussion/{id}', 'PostsController@show')->name('discussion.show');

Route::get('/user/register', 'UserController@register')->name('user.register');
Route::get('/user/login', 'UserController@login')->name('user.login');
Route::get('/verify/{confirm_code}', 'UserController@confirmEmail')->name('verify.email');
Route::post('/user/register', 'UserController@store')->name('user.register.post');
Route::post('/user/login', 'UserController@signin')->name('user.login.post');
