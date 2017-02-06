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
Route::get('/server/ssh', 'FrontController@showSSH');
Route::get('/server/vpn', 'FrontController@showVPN');
Route::get('/ssh/create/{id}', ['uses' => 'FrontController@createSSH']);
Route::post('/ssh/create/{id}', ['uses' => 'FrontController@postCreateSSH']);
Route::get('/vpn/create/{id}', ['uses' => 'FrontController@createVPN']);
Route::post('/vpn/create/{id}', ['uses' => 'FrontController@postCreateVPN']);
Route::get('/server/panel', 'PanelController@index');
Route::post('/server/panel/checkservice', 'PanelController@show');
Route::post('/server/panel/restart/dropbear', 'PanelController@restartDropbear');
Route::post('/server/panel/restart/openvpn', 'PanelController@restartOpenVPN');
Route::post('/server/panel/restart/squid', 'PanelController@restartSquid');
Route::get('/tools/host-to-ip', 'FrontController@hostToIp');
Route::get('/tools/host-to-ip/check', 'FrontController@hostToIpCheck');
Route::get('/tools/port-check', function(){
	return view('open-port');
});
Route::get('/tools/port-check/check', 'FrontController@portOpenCheck');
Route::get('/tools/dns-creator', 'FrontController@dnsCheck');
Route::post('/tools/dns-creator', 'FrontController@dnsAdd');
Route::get('/pages/vpn-config', 'FrontController@configList');
Route::get('/pages/ssh-checker', 'FrontController@sshChecker');
Route::post('/pages/ssh-checker', 'FrontController@postSshChecker');
Route::get('/pages/squid-proxy', 'FrontController@squid');
Route::get('/groups/{id}','GroupController@show');
Route::get('/crons/runcrons', 'FrontController@runCrons');

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
	Route::get('/manage/admin/server/add', 'ServerController@show');
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
	Route::get('/manage/admin/server/group', 'GroupController@index');
	Route::get('/manage/admin/server/group/add', function(){
		return view('admin.group-add');
	});
	Route::post('/manage/admin/server/group/add', 'GroupController@store');
	Route::post('/manage/admin/server/group/delete/{id}', ['uses' => 'GroupController@destroy']);
	Route::get('/manage/admin/ssh/list', 'SSHController@index');
	Route::post('/manage/admin/ssh/delete/{id}', ['uses' => 'SSHController@destroy']);
	Route::get('/manage/admin/config', 'ConfigController@index');
	Route::get('/manage/admin/config/add', 'ConfigController@add');
	Route::post('/manage/admin/config/add', 'ConfigController@store');
	Route::get('/download/config/{id}', ['uses' => 'ConfigController@show']);
	Route::post('/manage/admin/config/delete/{id}', ['uses' => 'ConfigController@destroy']);
	Route::get('/manage/admin/dns', 'DNSController@index');
	Route::get('/manage/admin/site/setting', 'SiteController@index');
	Route::post('/manage/admin/site/setting', 'SiteController@store');
	Route::get('/manage/admin/dns/add', function(){
		return view('admin.dns-add');
	});
	Route::post('/manage/admin/dns/add', 'DNSController@store');
	Route::post('/manage/admin/dns/delete/{id}', ['uses' => 'DNSController@destroy']);
	Route::get('/manage/admin/squid', 'SquidController@index');
	Route::get('/manage/admin/squid/add', function(){
		return view('admin.squid-add');
	});
	Route::post('/manage/admin/squid/add', 'SquidController@store');
	Route::post('/manage/admin/squid/delete/{id}', ['uses' => 'SquidController@destroy']);
	Route::get('/manage/admin/ads', 'AdsController@index');
	Route::get('/manage/admin/ads/add', function(){
		return view('admin.ads-add');
	});
	Route::post('/manage/admin/ads/add', 'AdsController@store');
	Route::post('/manage/admin/ads/delete/{id}', ['uses' => 'AdsController@destroy']);
	Route::get('/manage/admin/dns/list', 'FrontController@dnsList');
	Route::post('/manage/admin/dns/domain/delete/{id}', 'FrontController@dnsDomainDelete');
});
