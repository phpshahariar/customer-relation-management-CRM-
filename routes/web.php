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

Route::get('/reseller/campaign', 'SuperAdminController@campaign_reseller');
Route::get('/accept/request/{id}', 'SuperAdminController@reseller_campaign_accept');
Route::get('/reject/request/{id}', 'SuperAdminController@reseller_campaign_reject');

Route::get('/reseller/recharge', 'SuperAdminController@reseller_recharge');
Route::get('/reseller/send/mail', 'SuperAdminController@reseller_send_mail');
Route::post('/cash/recharge', 'SuperAdminController@reseller_recharge_send');

Route::get('/admin/logout', 'SuperAdminController@admin_logout');


// Reseller Point email//

Route::get('/create/email', 'ResellerController@create');
Route::post('/send/email', 'ResellerController@send_mail');
Route::get('/sent/email/store', 'ResellerController@send_mail_store');
Route::get('/send/delete/{id}', 'ResellerController@send_mail_delete');
Route::post('/group/mail', 'ResellerController@group_mail');
Route::get('/draft/email/store', 'ResellerController@save_mail');
Route::post('/save/email', 'ResellerController@store_mail');
Route::get('/create/group', 'ResellerController@create_group');
Route::post('/save/group', 'ResellerController@save_group');
Route::get('/active/group/{id}', 'ResellerController@active_group');
Route::get('/pending/group/{id}', 'ResellerController@pending_group');
Route::get('/delete/group/{id}', 'ResellerController@delete_group');

// Reseller Point SMS//

Route::get('/create/sms', 'ResellerController@create_sms');
Route::post('/send/sms', 'ResellerController@send_sms');



// Facebook Boost//

Route::get('/facebook/boost', 'ResellerController@introduction');
Route::post('/add/campaign', 'ResellerController@save_capmaign');
Route::get('/manage/campaign', 'ResellerController@manage_capmaign');

// Cash In

Route::get('/cash/in', 'ResellerController@cash_in');
Route::post('/cash/save', 'ResellerController@cash_save');


// File Upload//
Route::get('/contact/list', 'ResellerController@contact_list');
Route::post('import', 'ResellerController@import')->name('import');
Route::get('export', 'ResellerController@export')->name('export');


// Customer Information

Route::get('/create/mail', 'CustomerController@create_mail');
Route::post('/email/send', 'CustomerController@send_mail');
Route::get('/send/list', 'CustomerController@send_list');
Route::get('/create/customer/group', 'CustomerController@customer_group');
Route::post('/save/customer/group', 'CustomerController@save_customer_group');








// Api Route

Route::get('/group-data/{id}', function ($id){
    $output = '';
    $i = 0;
    $apps = App\Contact::with('group')->where('group_id', $id)->get();
    if($apps)
    {
        foreach ($apps as $key => $app) {
            $output.='<tr>'.
                '<td>'.$i++.'</td>'.
                '<td>'.$app->group->group_name.'</td>'.
                '<td>'.$app->name.'</td>'.
                '<td>'.$app->phone.'</td>'.
                '<td>'.$app->email.'</td>'.
                '</tr>';
        }
        return response()->json($output);
    }

});



































