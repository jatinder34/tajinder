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
Route::group(['prefix' => 'admin'], function () {
	Route::get('/login', 'Auth\LoginController@showLoginForm');
	Route::post('/login', 'Auth\LoginController@authenticate');
	Route::get('/logout', 'Auth\LoginController@logout');
	Route::get('/dashboard', 'Admin\DashboardController@index');
	Route::post('/forgotpassword', 'Auth\ResetPasswordController@forgotPassword');
	Route::get('/reset-password/{token}', 'Auth\ResetPasswordController@resetPasswordForm');
	Route::post('/reset-password', 'Auth\ResetPasswordController@setPassword');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


