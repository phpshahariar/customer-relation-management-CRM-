<?php

namespace App\Http\Controllers;

use App\Alert;
use App\Chat;
use App\ChatRegister;
use App\CustomerAccess;
use App\CustomerCampaign;
use App\CustomerCashIn;
use App\ServiceEmail;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Mail;
use Session;
class CRMController extends Controller
{
    public function customer_chating(Request $request){
        $this->validate($request,[
            'chating' => 'required',
        ]);
        $customer_chating = new Chat();
        $customer_chating->chating = $request->chating;
        $customer_chating->user_id = Auth::user()->id;
        $customer_chating->phone_number = Auth::user()->phone_number;
        $customer_chating->save();
        return redirect()->back();
    }

    public function registration(){
        $customer_cash_request = CustomerCashIn::where('user_id',Auth::user()->id)
            ->where('status',1)
            ->get();
        $customer_campaign_request = CustomerCampaign::where('user_id', Auth::user()->id)
            ->where('status', 1)
            ->get();

        $customerCampaign = 0;
        foreach ($customer_campaign_request as $customer_campaign){
            $customerCampaign = ($customerCampaign + ($customer_campaign->amount));
        }

        $customerCash = 0;
        foreach ($customer_cash_request as $customer_cash){
            $customerCash = ($customerCash + ($customer_cash->amount));

        }

        $totalCost = $customerCash - $customerCampaign;

        $customer_access = CustomerAccess::where('user_id', Auth::user()->id)->get();
        return view('customer.reg.registration', compact('totalCost','customer_access'));
    }

    public function registration_save(Request $request){
        $this->validate($request,[
            'name'  => 'required|max:255',
            'company_name'  => 'required',
            'phone'  => 'required|numeric|unique:chat_registers',
            'email_address'  => 'required|email',
            'district'  => 'required',
            'area'  => 'required',
            'address'  => 'required',
            'service'  => 'required',
            'notes'  => 'required',
            'customer_by'  => 'required',
        ]);



        $reg_customer = new ChatRegister();
        $reg_customer->user_id = Auth::user()->id;
        $reg_customer->created_by = Auth::user()->name;
        $reg_customer->name = $request->name;
        $reg_customer->company_name = $request->company_name;
        $reg_customer->phone = $request->phone;
        $reg_customer->email_address = $request->email_address;
        $reg_customer->district = $request->district;
        $reg_customer->area = $request->area;
        $reg_customer->address = $request->address;
        $reg_customer->service = $request->service;
        $reg_customer->notes = $request->notes;
        $reg_customer->customer_by = $request->customer_by;
        $reg_customer->chating = $request->chating;
        $reg_customer->save();
        return redirect()->back()->with('message', 'New Customer Add Successfully');
    }

    public function registration_info(Request $request){
        $reg_customer_info = ChatRegister::where('phone', $request->phone)->get();
        return $reg_customer_info;
    }

    public function customer_service_sms(Request $request){
        $url = 'http://banglakingssoft.powersms.net.bd/httpapi/sendsms';
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

        } else {
            echo sprintf("<p style='color:green;'>SUCCESS!</p>");
        }
        curl_close($ch);

        return redirect()->back()->with('message', 'Your Message Send Your Customer');
    }

    public function customer_service_email(Request $request){
        $this->validate($request, [
            'email' => 'required',
            'message' => 'required'
        ]);

        $emails = $request->input('email');
        $explode = explode(',', $emails);
        $service_email = new ServiceEmail();
        $service_email->user_id = Auth::user()->id;
        $service_email->email = $request->email;
        $service_email->message = $request->message;
        if ($service_email->save()){
            Session::put('message', $service_email->message);
            Session::put('user_id', $service_email->user_id);
        }

        Mail::send('customer.mail.page', $explode, function ($message) use ($explode) {
            $message->to($explode);
            $message->subject('Hello Service mail');
        });

        return redirect()->back()->with('message', 'Service Email Send Successfully');
    }

    public function customer_service_alert(Request $request){
        $this->validate($request,[
            'alert_date'  => 'required',
            'message'  => 'required',
        ]);

        $service_alert = new Alert();
        $service_alert->user_id = Auth::user()->id;
        $service_alert->alert_date = $request->alert_date;
        $service_alert->message = $request->message;
        $service_alert->save();
        return redirect()->back()->with('message', 'Alert Create Successfully');
    }
}
