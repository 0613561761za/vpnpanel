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

Route::get('/', 'MainController@index');
Route::get('/create/{id}', ['uses' => 'MainController@create'])->middleware('server');
Route::post('/create/{id}', ['uses' => 'MainController@store']);

/**
 * Authentication scaffolding.
 *
 */

// Authentication Routes...
$this->get('/manage/admin/login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('/manage/admin/login', 'Auth\LoginController@login');
$this->get('/manage/admin/logout', 'Auth\LoginController@logout')->name('logout');
	
/**
 * End
 */

/**
 * Admin routes.
 *
 */

Route::group(['middleware' => 'admin'], function(){
	Route::get('/manage/admin', function(){
		return view('admin.index');
	});
	Route::get('/manage/admin/server/add', function(){
		return view('admin.server-add');
	});
	Route::post('/manage/admin/server/add', 'ServerController@store');
	Route::post('/manage/admin/server/delete/{id}', ['uses' => 'ServerController@destroy']);
	Route::get('/manage/admin/server/list', 'ServerController@index');
	Route::get('/manage/admin/vpn/list', 'VPNController@index');
	Route::get('/manage/admin/vpn/user/{id}/list', ['uses' => 'VPNController@show']);
	Route::post('/manage/admin/vpn/delete/{id}', ['uses' => 'VPNController@destroy']);
	Route::get('/manage/admin/account/setting', function(){
		return view('admin.account-setting');
	});
	Route::post('/manage/admin/account/setting', 'MainController@update');
});

