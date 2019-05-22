<?php

namespace App\Http\Controllers;

use App\AdminLogin;
use Illuminate\Http\Request;
use Session;
class SuperAdminController extends Controller
{
    public function index(Request $request){

        $admin = AdminLogin::where('email', $request->email)->first();
        if ($admin){
            if (password_verify($request->password, $admin->password)){
                Session::put('id', $admin->id);
                Session::put('email', $admin->email);
                return redirect('/super/admin/dashboard');
            }else{
                return redirect('/super/admin')->with('message', 'Password dose not match');
            }

        }else{
            return redirect('/super/admin')->with('message', 'E-mail dose not match');
        }

    }

    public function admin_logout(){
        Session::forget('id');
        Session::forget('name');
        return redirect('/super/admin');
    }
}
