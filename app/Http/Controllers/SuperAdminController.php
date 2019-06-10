<?php

namespace App\Http\Controllers;

use App\AdminLogin;
use App\Campaign;
use App\CashIn;
use App\Recharge;
use App\Reseller;
use App\ResellerMail;
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



}
