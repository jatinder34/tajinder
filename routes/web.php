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
	Route::get('/createLink', 'Admin\DashboardController@createLink');
	Route::post('/createLink', 'Admin\DashboardController@generateLink');
	Route::get('/linkList', 'Admin\DashboardController@linkList');
	Route::post('/deleteLink', 'Admin\DashboardController@deleteLink');
	Route::get('/go/{id}', 'Admin\RedirectController@redirectLink');
	Route::get('/addfilterCategory', 'Admin\DashboardController@addfilterCategory');
	Route::post('/addfilterCategory', 'Admin\DashboardController@insertFilter');
	Route::get('/editfilterCategory/{id}', 'Admin\DashboardController@editfilterCategory');
	Route::post('/editfilterCategory', 'Admin\DashboardController@updatefilter');
	Route::post('/deleteFilter', 'Admin\DashboardController@deleteFilter');

	Route::get('/filterList', 'Admin\DashboardController@filterCategoryList');

});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


