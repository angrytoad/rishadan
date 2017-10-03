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


Route::get('/privacy-policy', 'Pages\PrivacyPolicyController@index')->name('privacy policy');
Route::get('/terms-and-conditions', 'Pages\TermsConditionsController@index')->name('terms conditions');
Route::get('/about-us', 'Pages\AboutUsController@index')->name('about us');


Route::group(['middleware' => ['auth'], 'prefix' => 'me'], function () {
    Route::get('/', 'Pages\HomeController@index')->name('dashboard');
    Route::get('/account', 'Pages\HomeController@index')->name('account');
    Route::get('/collection', 'Pages\HomeController@index')->name('collection');
});


