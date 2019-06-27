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

use App\CustomerContact;
    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', function () {
        return view('auth.login');
    });
    Route::get('/super/admin', function () {
        return view('admin');
    });

    Route::get('/login/reseller', 'SuperAdminController@login_reseller');

    Route::get('/admin/dashboard', 'SuperAdminController@admin_dashboard');
    Route::post('/super/admin/dashboard', 'SuperAdminController@index');

    Route::get('/dashboard/reseller', 'SuperAdminController@dashboard_reseller');
    Route::post('/reseller/dashboard', 'SuperAdminController@reseller_dashboard');



    Route::get('/reseller', 'SuperAdminController@create_reseller');
    Route::post('/save/reseller', 'SuperAdminController@save_reseller');



    Route::get('/reseller/logout', 'SuperAdminController@logout_reseller');

    Route::get('/reseller/campaign', 'SuperAdminController@campaign_reseller');
    Route::get('/accept/request/{id}', 'SuperAdminController@reseller_campaign_accept');
    Route::get('/reject/request/{id}', 'SuperAdminController@reseller_campaign_reject');

    Route::get('/reseller/recharge', 'SuperAdminController@reseller_recharge');
    Route::get('/reseller/send/mail', 'SuperAdminController@reseller_send_mail');
    Route::post('/cash/recharge', 'SuperAdminController@reseller_recharge_send');

    Route::get('/admin/logout', 'SuperAdminController@admin_logout');
    Route::get('/view/reseller/campaign/data', 'SuperAdminController@reseller_campaign_data');
    Route::get('/view/reseller/mail/data', 'SuperAdminController@reseller_mail_data');

// Customer Request to Admin

    Route::get('/customer/cashin', 'SuperAdminController@cashin_customer');
    Route::get('/accept/cashin/request/{id}', 'SuperAdminController@cashin_customer_approve');
    Route::get('/reject/cashin/request/{id}', 'SuperAdminController@cashin_customer_reject');
    Route::get('/customer/mail/list', 'SuperAdminController@customer_mail_list');
    Route::get('/customer/campaign', 'SuperAdminController@customer_campaign_list');
    Route::get('/accept/customer/request/{id}', 'SuperAdminController@customer_campaign_accept');
//Route::get('/delete/customer/request/{id}', 'SuperAdminController@customer_campaign_delete');
    Route::get('/customer/access/power', 'SuperAdminController@customer_access_power');
    Route::post('/access/power', 'SuperAdminController@customer_access_save');
    Route::get('/access/permitted/{id}', 'SuperAdminController@customer_permitted');
    Route::get('/access/denied/{id}', 'SuperAdminController@customer_denied');
    Route::get('/crm/access/permitted/{id}', 'SuperAdminController@crm_customer_permitted');
    Route::get('/crm/access/denied/{id}', 'SuperAdminController@crm_customer_denied');
    Route::get('/view/campaign/data', 'SuperAdminController@customer_campaign_view');
    Route::get('/view/mail/send', 'SuperAdminController@customer_mail_view');
    Route::get('/customer/cash/out', 'SuperAdminController@customer_cash_out');
    Route::get('/cashout/processing/{id}', 'SuperAdminController@customer_cash_out_processing');
    Route::get('/cashout/success/{id}', 'SuperAdminController@customer_cash_out_success');
    Route::get('/cashout/waiting/{id}', 'SuperAdminController@customer_cash_out_waiting');

    Route::get('/campaign/low', 'SuperAdminController@campaign_low');
    Route::post('/save/campaign/low', 'SuperAdminController@campaign_low_save');
    Route::get('/active/low/{id}', 'SuperAdminController@campaign_low_active');
    Route::get('/not/active/low/{id}', 'SuperAdminController@campaign_low_not_active');
    Route::get('/delete/low/{id}', 'SuperAdminController@campaign_low_delete');


    Route::get('/cashin/method', 'SuperAdminController@cashin_method');
    Route::get('/add/method', 'SuperAdminController@add_method');
    Route::post('/method/save', 'SuperAdminController@save_method');
    Route::get('/edit/method/{id}', 'SuperAdminController@edit_method');
    Route::post('/method/update', 'SuperAdminController@update_method');
    Route::get('/active/method/{id}', 'SuperAdminController@active_method');
    Route::get('/pending/method/{id}', 'SuperAdminController@pending_method');
    Route::get('/customer/list', 'SuperAdminController@customer_list');
    Route::get('/reseller/list', 'SuperAdminController@reseller_list');


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
    Route::get('/delete/email/{id}', 'CustomerController@delete_item');
    Route::post('/customer/group/mail', 'CustomerController@group_mail');
    Route::get('/create/customer/group', 'CustomerController@customer_group');
    Route::post('/save/customer/group', 'CustomerController@save_customer_group');
    Route::get('/active/customer/group/{id}', 'CustomerController@active_customer_group');
    Route::get('/pending/customer/group/{id}', 'CustomerController@pending_customer_group');
    Route::get('/delete/customer/group/{id}', 'CustomerController@delete_customer_group');
    Route::get('/contact/customer/list', 'CustomerController@upload_customer_data');
    Route::post('/single/data/add', 'CustomerController@single_customer_data');
    Route::get('/create/customer/sms', 'CustomerController@create_customer_sms');
    Route::post('/group/sms/send', 'CustomerController@group_customer_sms');
    Route::post('/send/customer/sms', 'CustomerController@sms_customer');
    Route::get('/send/customer/sms/list', 'CustomerController@send_sms_customer_list');
    Route::get('/send/customer/group/list', 'CustomerController@send_sms_customer_group');
    Route::post('/send-sms-multi', 'CustomerController@sendSmsMulti');
    Route::get('/view/sms/data', 'CustomerController@sendSmsView');
    Route::get('/sms/system', 'CustomerController@sendSystem');
    Route::get('/email/system', 'CustomerController@emailSystem');
    Route::get('/campaign/system', 'CustomerController@campaignSystem');
    Route::get('/cash/system', 'CustomerController@cashSystem');
    Route::get('/contact/system', 'CustomerController@contactSystem');

// Customer File Upload

    Route::post('import-customer', 'CustomerController@customer_import')->name('import-customer');
    Route::get('export-customer', 'CustomerController@customer_export')->name('export-customer');
    Route::get('/phoneNumber/sms', 'CustomerController@phoneNumberSms');
    Route::get('/customer/edit/info/{id}', 'CustomerController@editCustomerData');
    Route::post('/update/customer/data', 'CustomerController@updateCustomerData');


// Customer facebook marketing

    Route::get('/customer/facebook/boost', 'CustomerController@create_customer_fb_marketing');
    Route::post('/add/customer/campaign', 'CustomerController@customer_campaign_add');
    Route::get('/customer/manage/campaign', 'CustomerController@customer_campaign_manage');

// Customer CashIn Information

    Route::get('/cashin/request', 'CustomerController@customer_cashin');
    Route::post('/request/customer/cashin', 'CustomerController@customer_cashin_request');
    Route::get('/delete/customer/cashin/{id}', 'CustomerController@customer_cashin_delete');
    Route::get('/send/money', 'CustomerController@customer_send_money');
    Route::get('/cash/out/money', 'CustomerController@customer_cashout_money');
    Route::post('/cash/out', 'CustomerController@customer_cashout');
    Route::post('/customer/send/money', 'CustomerController@send_money');
    Route::get('/customer/user/id', 'CustomerController@user_id');


    Route::get('/select/payment/method', 'CustomerController@method_option');
    Route::get('/customer/access', 'CustomerController@customer_access');
    Route::post('/need/access/power', 'CustomerController@need_customer_access');
    Route::get('/setting/option', 'CustomerController@customer_setting');
    Route::get('/edit/profile/{id}', 'CustomerController@edit_profile');
    Route::post('/update/setting', 'CustomerController@update_profile');

    // Customer Registration

    Route::get('/customer/registration', 'CustomerController@customer_registration');


    // Customer Chating

    Route::post('/chating', 'CRMController@customer_chating');
    Route::get('/registration', 'CRMController@registration');
    Route::post('/save/customer/information', 'CRMController@registration_save');
    Route::get('/customer/reg/info', 'CRMController@registration_info');
    Route::post('/customer/service/sms', 'CRMController@customer_service_sms');
    Route::post('/email/send', 'CRMController@customer_service_email');
    Route::post('/alert/send', 'CRMController@customer_service_alert');


//Reseller Api Route

    Route::get('/group-data/{id}', function ($id) {
        $output = '';
        $i = 0;
        $apps = App\Contact::with('group')->where('group_id', $id)->get();
        if ($apps) {
            foreach ($apps as $key => $app) {
                $output .= '<tr>' .
                    '<td>' . $i++ . '</td>' .
                    '<td>' . $app->group->group_name . '</td>' .
                    '<td>' . $app->name . '</td>' .
                    '<td>' . $app->phone . '</td>' .
                    '<td>' . $app->email . '</td>' .
                    '</tr>';
            }
            return response()->json($output);
        }

    });


// Customer Panel

    Route::get('/customer-data/{id}', function ($id) {
        $output = '';
        $i = 0;
        $apps = App\CustomerContact::with('customer_group')->where('group_id', $id)->get();
        if ($apps) {
            foreach ($apps as $key => $app) {
                $output .= '<tr>' .
                    '<td>' . $i++ . '</td>' .
                    '<td>' . $app->customer_group->group_name . '</td>' .
                    '<td>' . $app->name . '</td>' .
                    '<td>' . $app->phone . '</td>' .
                    '<td>' . $app->email . '</td>' .
                    '</tr>';
            }

            return response()->json($output);
        }

    });

Route::get('/customer-single-data/{id}', function ($id) {
    $output = '';
    $i = 0;
    $apps = App\SingleData::with('customer_group')->where('group_id', $id)->get();
    if ($apps) {
        foreach ($apps as $key => $app) {
            $output .= '<tr>' .
                '<td>' . $i++ . '</td>' .
                '<td>' . $app->customer_group->group_name . '</td>' .
                '<td>' . $app->name . '</td>' .
                '<td>' . $app->phone . '</td>' .
                '<td>' . $app->email . '</td>' .
                '</tr>';
        }

        return response()->json($output);
    }

});

    Route::get('/customer-sms/{id}', function ($id) {
        $outputsms = '';
        $i = 0;
        $apps = App\CustomerContact::with('customer_group')->where('group_id', $id)->get();
        if ($apps) {
            foreach ($apps as $key => $app) {
                $outputsms .=
                    '<tr>' .
                    '<td>' . $i++ . '</td>' .
                    '<td>' . $app->customer_group->group_name . '</td>' .
                    '<td>' . $app->name . '</td>' .
                    '<td>' . $app->phone . '</td>' .
                    '<td style="display: none;"><input type="text" name="number[]" value="' . $app->phone . '"></td>' .
                    '</tr>';
            }
            return response()->json($outputsms);
        }

    });





































