<?php

namespace App\Http\Controllers;

use App\AdminLogin;
use App\Campaign;
use App\CashIn;
use App\CashOut;
use App\CustomerAccess;
use App\CustomerCampaign;
use App\CustomerCashIn;
use App\CustomerMail;
use App\PaymentMethod;
use App\Recharge;
use App\Reseller;
use App\ResellerMail;
use App\User;
use Illuminate\Http\Request;
use Session;
use DB;
class SuperAdminController extends Controller
{

    public function admin_dashboard(){
        return view('admin.home.index');
    }



    public function index(Request $request){

        $email = $request->email;
        $password = md5($request->password);
        $result = DB::table('admin_logins')
            ->where('email', $email)
            ->where('password', $password)
            ->first();
//        echo "</pre>";
//        print_r($result);

        if ($result){
            Session::put('email', $result->email);
            Session::put('id', $result->id);
            return redirect('/admin/dashboard');

//            echo "Success";
        }else{
            return redirect('/super/admin');
        }

//        $admin = AdminLogin::where('email', $request->email)->first();
//        if ($admin){
//            if (password_verify($request->password, $admin->password)){
//                Session::put('id', $admin->id);
//                Session::put('email', $admin->email);
//                return redirect('/super/admin/dashboard');
//            }else{
//                return redirect('/super/admin')->with('message', 'Password dose not match');
//            }
//
//        }else{
//            return redirect('/super/admin')->with('message', 'E-mail dose not match');
//        }

//        return view('admin.home.index');

    }

    public function admin_logout(){
        Session::forget('id');
        Session::forget('email');
        Session::forget('password');
        return redirect('/super/admin');
    }

    public function create_reseller(){
        return view('admin.includes.reseller-from');
    }

    public function login_reseller(){
        return view('re-sellar.login.login');
    }

    public function dashboard_reseller(){
        $cash_show = Recharge::where('reseller_account_id', Session::get('resellar_id'))->get();
        $totalCash = 0;
        foreach ($cash_show as $key => $cash){
            $totalCash = ($totalCash + ($cash->amount));

        }
        return view('re-sellar.home.index', compact('totalCash'));
    }

    public function reseller_dashboard(Request $request){
        $customer = Reseller::where('email', $request->email)->first();
        if ($customer){
            if (password_verify($request->password, $customer->password)){
                Session::put('resellar_id', $customer->id);
                Session::put('name', $customer->name);
                return redirect('/dashboard/reseller');
            }else{
                return redirect('/login/reseller')->with('error', 'Password dose not match');
            }

        }else{
            return redirect('/login/reseller')->with('message', 'E-mail dose not match');
        }
    }

    public function save_reseller(Request $request){
        $this->validate($request,[
            'name'  => 'required|string|max:255',
            'email' => 'required|unique:resellers|string|max:255|email',
            'password' =>'required|string|min:8|confirmed',
            'account_number' =>'required|string|unique:resellers|min:3'
        ]);

        $create_reseller = new Reseller();
        $create_reseller->name = $request->name;
        $create_reseller->email = $request->email;
        $create_reseller->role = $request->role;
        $create_reseller->account_number = $request->account_number;
        $create_reseller->password = bcrypt($request->password);
        $create_reseller->save();
        if ($create_reseller){
            Session::put('resellar_id', $create_reseller->id);
            Session::put('name', $create_reseller->name);
            Session::put('email', $create_reseller->email);
            Session::put('account_number', $create_reseller->account_number);
        }
        return redirect()->back()->with('message', 'Reseller Account Create Successfully');
    }

    public function logout_reseller(){
        Session::forget('resellar_id');
        Session::forget('email');
        Session::forget('password');
        return redirect('/login/reseller');
    }


    // Reseller Campaign Request


    public function campaign_reseller(){
        $campaign_request = Campaign::orderBy('id', 'desc')->get();
        return view('admin.Campaign.campaign-request', compact('campaign_request'));
    }


    public function reseller_campaign_accept($id){
        $campaign_request_accept = Campaign::find($id);
        $campaign_request_accept->status =1;
        $campaign_request_accept->save();
        return redirect()->back()->with('message', 'Campaign Request Accepted');
    }


    public function reseller_campaign_reject($id){
        $campaign_request_reject = Campaign::find($id);
        $campaign_request_reject->status =0;
        $campaign_request_reject->save();
        return redirect()->back()->with('message', 'Campaign Request Rejected');
    }


    // ReSeller Recharge

    public function reseller_recharge(){
        $all_recharge = Recharge::get();

        $totalrecharge = 0;
        foreach ($all_recharge as $recharge){
            $totalrecharge = ($totalrecharge + ($recharge->amount));

        }


        $all_reseller = Reseller::all();
        return view('admin.recharge.reseller-recharge', compact('all_recharge', 'all_reseller', 'totalrecharge'));
    }


    public function reseller_recharge_send(Request $request){
        $reseller_recharge = new Recharge();
        $reseller_recharge->amount = $request->amount;
        $reseller_recharge->reseller_account_id = $request->reseller_account_id;
//        $reseller_recharge->reseller_id = Session::get('resellar_id');
        $reseller_recharge->save();
        return redirect()->back()->with('message', 'ReSeller Recharge Successfully Done');
    }


    public function reseller_send_mail(){
        $send_mail = ResellerMail::get();
        return view('admin.email.mail-list', compact('send_mail'));
    }


    // Customer Information

    public function cashin_customer(){
        $customer_cash_in = CustomerCashIn::get();
        return view('admin.customer.customer-cashin', compact('customer_cash_in'));
    }


    public function cashin_customer_approve($id){
        $customer_cashin_approve = CustomerCashIn::find($id);
        $customer_cashin_approve->status = 1;
        $customer_cashin_approve->save();
        return redirect()->back()->with('message', 'CashIn Request Approved');
    }

    public function cashin_customer_reject($id){
        $customer_cashin_reject = CustomerCashIn::find($id);
        $customer_cashin_reject->status = 0;
        $customer_cashin_reject->save();
        return redirect()->back()->with('message', 'CashIn Request Pending');
    }


    public function customer_mail_list(){
        $all_customer_mail = CustomerMail::get();
        return view('admin.customer.mail-view', compact('all_customer_mail'));
    }


    public function customer_campaign_list(){
        $campaign_request = CustomerCampaign::get();
        return view('admin.customer.customer-campaign', compact('campaign_request'));
    }


    public function customer_campaign_accept($id){
        $accept_customer_campaign = CustomerCampaign::find($id);
        $accept_customer_campaign->status = 1;
        $accept_customer_campaign->save();
        return redirect()->back()->with('message', 'Customer Campaign Accepted');
    }


//    public function customer_campaign_delete($id){
//        $accept_customer_campaign = CustomerCampaign::find($id);
//        $accept_customer_campaign->status = 1;
//        $accept_customer_campaign->update();
//        return redirect()->back()->with('message', 'Customer Campaign Deleted');
//    }


    public function customer_access_power(){
        $all_access = CustomerAccess::OrderBy('id', 'desc')->get();
        return view('admin.customer.customer-access',compact('all_access'));
    }



//    public function customer_access_save(Request $request){
//
//    }

    public function customer_permitted($id){
        $customer_permitted = CustomerAccess::find($id);
        $customer_permitted->money_status = 0;
        $customer_permitted->save();
        return redirect()->back()->with('message', 'Customer Denied Successfully');
    }

    public function customer_denied($id){
        $customer_permitted = CustomerAccess::find($id);
        $customer_permitted->money_status = 1;
        $customer_permitted->save();
        return redirect()->back()->with('message', 'Customer Permitted Successfully');
    }

    public function crm_customer_permitted($id){
        $customer_permitted = CustomerAccess::find($id);
        $customer_permitted->crm_status = 0;
        $customer_permitted->save();
        return redirect()->back()->with('message', 'Customer Denied Successfully');
    }

    public function crm_customer_denied($id){
        $customer_permitted = CustomerAccess::find($id);
        $customer_permitted->crm_status = 1;
        $customer_permitted->save();
        return redirect()->back()->with('message', 'Customer Denied Successfully');
    }


    public function customer_campaign_view(Request $get){
        $id = $get->id;
        $view = CustomerCampaign::find($id);
        return $view;
    }

    public function customer_mail_view(Request $get){
        $id = $get->id;
        $mail = CustomerMail::find($id);
        return $mail;
    }

    public function customer_cash_out(){
        $show_customer_cash_out = CashOut::get();
        return view('admin.customer.customer-cashout', compact('show_customer_cash_out'));
    }

    public function customer_cash_out_waiting($id){
        $cash_out_processing = CashOut::find($id);
        $cash_out_processing->status = 0;
        $cash_out_processing->save();
        return redirect()->back()->with('message', 'Cash Out Request Processing');
    }
    public function customer_cash_out_processing($id){
        $cash_out_processing = CashOut::find($id);
        $cash_out_processing->status = 1;
        $cash_out_processing->save();
        return redirect()->back()->with('message', 'Cash Out Request Success');
    }
    public function customer_cash_out_success($id){
        $cash_out_processing = CashOut::find($id);
        $cash_out_processing->status = 2;
        $cash_out_processing->save();
        return redirect()->back()->with('message', 'Cash Out Request Success');
    }


    //Customer Cash Out End




    public function reseller_campaign_data(Request $get){
        $id = $get->id;
        $view = Campaign::find($id);
        return $view;
    }

    public function reseller_mail_data(Request $get){
        $id = $get->id;
        $mail = ResellerMail::find($id);
        return $mail;
    }


    // Campaign Low

    public function campaign_low(){
        return view('admin.low');
    }


    //Cash In Method information

    public function cashin_method(){
        $show_method = PaymentMethod::get();
        return view('admin.cash.cashin-method', compact('show_method'));
    }

    public function add_method(){

        return view('admin.cash.add-method');
    }

    public function save_method(Request $request){
        $payment_method = new PaymentMethod();
        $payment_method->method_name = $request->method_name;
        $payment_method->method_description = $request->method_description;
        $payment_method->save();
        return redirect('cashin/method')->with('message', 'PaymentMethod Add Successfully');
    }


    public function edit_method($id){
        $edit_method = PaymentMethod::find($id);
        return view('admin.cash.edit-method', compact('edit_method'));
    }

    public function update_method(Request $request){
        $this->validate($request,[
            'method_name' => 'required',
            'method_description' => 'required',
        ]);

        $update_method = PaymentMethod::find($request->id);
        $update_method->method_name = $request->method_name;
        $update_method->method_description = $request->method_description;
        $update_method->update();
        return redirect('cashin/method')->with('message', 'PaymentMethod Update Successfully');
    }

    public function active_method($id){
        $active_method = PaymentMethod::find($id);
        $active_method->status = 0;
        $active_method->save();
        return redirect()->back()->with('message', 'PaymentMethod Pending Successfully');
    }

    public function pending_method($id){
        $active_method = PaymentMethod::find($id);
        $active_method->status = 1;
        $active_method->save();
        return redirect()->back()->with('message', 'PaymentMethod Active Successfully');
    }

    public function customer_list(){
        $customer_list = User::OrderBy('id', 'desc')->get();
        return view('admin.customer.customer-list', compact('customer_list'));
    }

    public function reseller_list(){
        $reseller_list= Reseller::OrderBy('id', 'desc')->get();
        return view('admin.customer.reseller-list', compact('reseller_list'));
    }


}
