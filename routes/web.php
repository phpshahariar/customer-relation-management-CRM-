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
    return view('auth.login');
});

Route::get('/super/admin', function () {
    return view('admin');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/dashboard', 'SuperAdminController@admin_dashboard');
Route::post('/super/admin/dashboard', 'SuperAdminController@index');

Route::get('/reseller', 'SuperAdminController@create_reseller');
Route::post('/save/reseller', 'SuperAdminController@save_reseller');

Route::get('/dashboard/reseller', 'SuperAdminController@dashboard_reseller');
Route::post('/reseller/dashboard', 'SuperAdminController@reseller_dashboard');
Route::get('/login/reseller', 'SuperAdminController@login_reseller');
Route::get('/reseller/logout', 'SuperAdminController@logout_reseller');

Route::get('/admin/logout', 'SuperAdminController@admin_logout');
