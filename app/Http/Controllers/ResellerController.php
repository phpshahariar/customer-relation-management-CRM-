<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Contact;
use App\Email;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Notifications\GroupMail;
use App\ResellerMail;
use App\SMS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Maatwebsite\Excel\Facades\Excel;
use Session;
class ResellerController extends Controller
{
    public function create()
    {
        return view('re-sellar.email.create-email');
    }

    public function send_mail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'message' => 'required'
        ]);

        $emails = $request->input('email');
        $explode = explode(',', $emails);

        $send_mail = new ResellerMail();
        $send_mail->email = $request->email;
        $send_mail->message = $request->message;
        $send_mail->save();
        Session::put('message', $send_mail->message);

        //$explode = $send_mail->toArray();
        Mail::send('re-sellar.Email.mail-view', $explode, function ($message) use ($explode) {
            $message->to($explode);
            $message->subject('Hello');
        });

        return redirect()->back()->with('message', 'Your Mail has been Send');
    }


    public function save_mail()
    {
        $send_mail = ResellerMail::orderBy('id', 'desc')->get();
        return view('re-sellar.Email.save', compact('send_mail'));
    }


    public function send_mail_store()
    {
        $send_mail = ResellerMail::orderBy('id', 'desc')->get();
        return view('re-sellar.Email.sent-mail', compact('send_mail'));
    }


    public function group_mail(Request $request)
    {
        $users = Contact::all();
        $all_mail = $users->pluck('email')->toArray();

        Mail::send('re-sellar.email', $all_mail, function ($message) use ($all_mail) {
            $message->to($all_mail)->subject('Hello group');
//            $mail->notify(new GroupMail());
//        Notification::send($users, new GroupMail());

        });

        return redirect()->back()->with('message', 'Group Mail Send Successfully');
    }

    public function contact_list()
    {
        $show_contact = Contact::all();
        return view('re-sellar.Email.contact', compact('show_contact'));
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function import()
    {

        Excel::import(new UsersImport, request()->file('upload_file'));

        return back()->with('message', 'Contact File Upload Successfully');
    }


    public function create_sms()
    {
        return view('re-sellar.sms.create');
    }

    public function send_sms(Request $request)
    {

        $url = 'http://powersms.banglaphone.net.bd/httpapi/sendsms';
        $fields = array(
            'userId' => urlencode('banglakings'),
            'password' => urlencode('bksoft2018'),
            'smsText' => urlencode($request->input('message')),
            'commaSeperatedReceiverNumbers' => $request->input('number'),
        );
        $fields_string = '';
        foreach ($fields as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';

        }
        rtrim($fields_string, '&');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
// If you have proxy
// $proxy = '<proxy-ip>:<proxy-port>';
// curl_setopt($ch, CURLOPT_PROXY, $proxy);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        if ($result === false) {
            echo sprintf('<span>%s</span>CURL error:', curl_error($ch));

        }
        else {
            echo sprintf("<p style='color:green;'>SUCCESS!</p>");
        }
        curl_close($ch);

        return redirect()->back();
    }


//        $new_sms = new SMS();
//        $new_sms->number = $request->number;
//        $new_sms->message = $request->message;
//        $new_sms->save();
//        return redirect()->back()->with('message', 'Your SMS Send to Customer');
//    }


    public function introduction(){
        return view('re-sellar.facebook.introduction-page');
    }

    public function save_capmaign(Request $request){
        $save_campaign = new Campaign();
        $save_campaign->start_date = $request->start_date;
        $save_campaign->end_date = $request->end_date;
        $save_campaign->link = $request->link;
        $save_campaign->amount = $request->amount;
        $save_campaign->filtering = $request->filtering;
        $save_campaign->save();
        return redirect()->back()->with('message', 'Your Campaign Added');
    }
}
