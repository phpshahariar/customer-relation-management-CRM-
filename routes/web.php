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


// Reseller Point email//

Route::get('/create/email', 'ResellerController@create');
Route::post('/send/email', 'ResellerController@send_mail');
Route::get('/sent/email/store', 'ResellerController@send_mail_store');
Route::post('/group/mail', 'ResellerController@group_mail');
Route::get('/draft/email/store', 'ResellerController@save_mail');
Route::post('/save/email', 'ResellerController@store_mail');

// Reseller Point SMS//

Route::get('/create/sms', 'ResellerController@create_sms');
Route::post('/send/sms', 'ResellerController@send_sms');



// Facebook Boost//

Route::get('/facebook/boost', 'ResellerController@introduction');
Route::post('/add/campaign', 'ResellerController@save_capmaign');






// File Upload//
Route::get('/contact/list', 'ResellerController@contact_list');
Route::post('import', 'ResellerController@import')->name('import');
Route::get('export', 'ResellerController@export')->name('export');





































