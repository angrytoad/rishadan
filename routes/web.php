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
    return view('layouts.welcome');
});

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/verify/{token}', 'Auth\RegisterController@verify')->name('verify');
Route::get('/verified', 'Auth\RegisterController@verified')->name('verified');
Route::post('/verified', 'Auth\RegisterController@resend')->name('resend');

Route::group(['middleware' => ['auth', 'auth.verified'], 'prefix' => 'me'], function () {
    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::get('/account', 'HomeController@index')->name('account');
    Route::get('/collection', 'HomeController@index')->name('collection');
});


