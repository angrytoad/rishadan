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

Route::get('/privacy-policy', 'Pages\PrivacyPolicyController@index')->name('privacy policy');
Route::get('/terms-and-conditions', 'Pages\TermsConditionsController@index')->name('terms conditions');
Route::get('/about-us', 'Pages\AboutUsController@index')->name('about us');

Route::group(['middleware' => ['auth', 'auth.verified'], 'prefix' => 'me'], function () {

    Route::group(['middleware' => ['auth', 'auth.verified'], 'prefix' => 'account'], function () {
        Route::get('/', 'Account\AccountController@index')->name('account');
        Route::get('/add_address', 'Account\AccountController@add_address')->name('account.add_address');
        Route::post('/add_address', 'Account\AccountController@post_add_address')->name('post.account.add_address');
        Route::get('/address/{uuid}', 'Account\AccountController@edit_address')->name('account.edit_address');
        Route::post('/address/{uuid}', 'Account\AccountController@post_edit_address')->name('post.account.edit_address');
    });

    Route::get('/', 'Pages\HomeController@index')->name('dashboard');
    Route::get('/collection', 'Pages\HomeController@index')->name('collection');
});