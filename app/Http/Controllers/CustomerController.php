<?php

namespace App\Http\Controllers;

use App\CustomerGroup;
use App\CustomerMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Session;
use Auth;


class CustomerController extends Controller
{
    public function create_mail()
    {
        return view('customer.mail.create-email');
    }


    public function send_mail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'message' => 'required'
        ]);

        $emails = $request->input('email');
        $explode = explode(',', $emails);

        $send_mail = new CustomerMail();
        $send_mail->email = $request->email;
        $send_mail->message = $request->message;
        $send_mail->user_account = $request->user_account;
        $send_mail->user_id = $request->user_id;
        $send_mail->save();
        Session::put('message', $send_mail->message);
        Session::put('user_account', $send_mail->user_account);
        Session::put('user_id', $send_mail->user_id);

        //$explode = $send_mail->toArray();
        Mail::send('customer.mail.mail-view', $explode, function ($message) use ($explode) {
            $message->to($explode);
            $message->subject('Hello');
        });

        return redirect()->back()->with('message', 'Your Mail has been Send');
    }

    public function send_list(){
        $send_mail = CustomerMail::where('user_id', Auth::user()->id)->get();
        return view('customer.mail.save', compact('send_mail'));
    }

    public function customer_group(){
        return view('customer.group.group');
    }

    public function save_customer_group(Request $request){
        $this->validate($request,[
            'group_name' => 'required|alpha|max:255',
            'status' => 'required',
        ]);

        $save_group = new CustomerGroup();
        $save_group->group_name = $request->group_name;
        $save_group->status = $request->status;
        $save_group->user_account = $request->user_account;
        $save_group->user_id = $request->user_id;
        $save_group->save();
        return redirect()->back()->with('message', 'Group Create Successfully');
    }
}
