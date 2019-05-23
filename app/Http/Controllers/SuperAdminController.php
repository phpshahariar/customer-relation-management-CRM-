<?php

namespace App\Http\Controllers;

use App\AdminLogin;
use App\Reseller;
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
        return view('re-sellar.home.index');
    }

    public function reseller_dashboard(Request $request){
        $customer = Reseller::where('email', $request->email)->first();
        if ($customer){
            if (password_verify($request->password, $customer->password)){
                Session::put('id', $customer->id);
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
            'password' =>'required|string|min:8|confirmed'
        ]);

        $create_reseller = new Reseller();
        $create_reseller->name = $request->name;
        $create_reseller->email = $request->email;
        $create_reseller->role = $request->role;
        $create_reseller->password = bcrypt($request->password);
        $create_reseller->save();
        if ($create_reseller){
            Session::put('id', $create_reseller->id);
            Session::put('name', $create_reseller->name);
            Session::put('email', $create_reseller->email);
        }
        return redirect('/dashboard/reseller');
    }

    public function logout_reseller(){
        Session::forget('id');
        Session::forget('email');
        Session::forget('password');
        return redirect('/login/reseller');
    }


}
