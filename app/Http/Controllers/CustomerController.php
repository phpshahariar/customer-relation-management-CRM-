<?php

namespace App\Http\Controllers;

use App\CampaignLow;
use App\CashOut;
use App\Chat;
use App\CustomerAccess;
use App\CustomerCampaign;
use App\CustomerCashIn;
use App\CustomerContact;
use App\CustomerGroup;
use App\CustomerMail;
use App\CustomerSendMoney;
use App\CustomerSMS;
use App\Exports\CustomersExport;
use App\Exports\UsersExport;
use App\GroupMailStore;
use App\Imports\CustomersImport;
use App\Imports\UsersImport;
use App\PaymentMethod;
use App\SingleData;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Session;
use Auth;
use Image;

class CustomerController extends Controller
{
    public function emailSystem(){
        $customer_access = CustomerAccess::where('user_id', Auth::user()->id)
            ->where('money_status', 1)
            ->orWhere('crm_status', 1)
            ->get();
        $show_group = CustomerGroup::where('user_id', Auth::user()->id)->get();
        $show_contact = CustomerContact::get();
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

        $show_customer_cash_out = CashOut::where('user_id', Auth::user()->id)->get();
        $cashOut = 0;
        foreach ($show_customer_cash_out as $customer_cash_out){
            $cashOut = ($cashOut + ($customer_cash_out->bank_amount));
        }

        $totalCashOut = $customerCash - $cashOut;
        $totalCost = $customerCash - $customerCampaign;
        return view('customer.home.mail-page', compact(
            'customer_access',
            'show_group',
            'show_contact',
            'totalCost',
            'totalCashOut'
        ));
    }

    public function create_mail()
    {
        $customer_access = CustomerAccess::where('user_id', Auth::user()->id)
            ->where('money_status', 1)
            ->orWhere('crm_status', 1)
            ->get();
        $show_group = CustomerGroup::where('user_id', Auth::user()->id)->get();
        $show_contact = CustomerContact::get();
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

        $show_customer_cash_out = CashOut::where('user_id', Auth::user()->id)->get();
        $cashOut = 0;
        foreach ($show_customer_cash_out as $customer_cash_out){
            $cashOut = ($cashOut + ($customer_cash_out->bank_amount));
        }

        $totalCashOut = $customerCash - $cashOut;
        $totalCost = $customerCash - $customerCampaign;
        return view('customer.mail.create-email', compact('customer_access', 'show_group', 'show_contact','totalCost', 'totalCashOut'));
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

    public function send_list()
    {
        $send_mail = CustomerMail::where('user_id', Auth::user()->id)->get();
        $customer_access = CustomerAccess::where('user_id', Auth::user()->id)
            ->where('money_status', 1)
            ->orWhere('crm_status', 1)
            ->get();


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

        $show_customer_cash_out = CashOut::where('user_id', Auth::user()->id)->get();
        $cashOut = 0;
        foreach ($show_customer_cash_out as $customer_cash_out){
            $cashOut = ($cashOut + ($customer_cash_out->bank_amount));
        }

        $totalCashOut = $customerCash - $cashOut;


        $totalCost = $customerCash - $customerCampaign;
        return view('customer.mail.save', compact('send_mail', 'customer_access', 'totalCost', 'totalCashOut'));
    }

    public function delete_item($id){
        $delete_mail = CustomerMail::find($id);
        $delete_mail->delete();
        return redirect()->back()->with('message', 'Mail has been Deleted');
    }

    public function customer_group()
    {
        $all_group = CustomerGroup::where('user_id', Auth::user()->id)->get();
        $customer_access = CustomerAccess::where('user_id', Auth::user()->id)
            ->where('money_status', 1)
            ->orWhere('crm_status', 1)
            ->get();


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

        $show_customer_cash_out = CashOut::where('user_id', Auth::user()->id)->get();
        $cashOut = 0;
        foreach ($show_customer_cash_out as $customer_cash_out){
            $cashOut = ($cashOut + ($customer_cash_out->bank_amount));
        }

        $totalCashOut = $customerCash - $cashOut;


        $totalCost = $customerCash - $customerCampaign;
        return view('customer.group.group', compact('all_group', 'customer_access', 'totalCost', 'totalCashOut'));
    }

    public function save_customer_group(Request $request)
    {
        $this->validate($request, [
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


    public function active_customer_group($id)
    {
        $active_group = CustomerGroup::find($id);
        $active_group->status = 0;
        $active_group->save();
        return redirect()->back()->with('message', 'Group Pending Successfully');
    }

    public function pending_customer_group($id)
    {
        $pending_group = CustomerGroup::find($id);
        $pending_group->status = 1;
        $pending_group->save();
        return redirect()->back()->with('message', 'Group Active Successfully');
    }

    public function delete_customer_group($id)
    {
        $delete_group = CustomerGroup::find($id);
        $delete_group->delete();
        return redirect()->back()->with('message', 'Group Delete Successfully');
    }

    public function upload_customer_data()
    {
        $show_group = CustomerGroup::where('user_id', Auth::user()->id)->get();
        $show_contact = CustomerContact::where('group_id', Auth()->user()->id)->get();
        $new_show = SingleData::where('group_id', Auth()->user()->id)->get();

//        foreach ($show_contact as $contact) {
//            $total = $contact->count('name');
//
//        }

        $customer_access = CustomerAccess::where('user_id', Auth::user()->id)
            ->where('money_status', 1)
            ->orWhere('crm_status', 1)
            ->get();

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

        $show_customer_cash_out = CashOut::where('user_id', Auth::user()->id)->get();
        $cashOut = 0;
        foreach ($show_customer_cash_out as $customer_cash_out){
            $cashOut = ($cashOut + ($customer_cash_out->bank_amount));
        }

        $totalCashOut = $customerCash - $cashOut;


        $totalCost = $customerCash - $customerCampaign;
        return view('customer.group.customer-contact', compact('show_group', 'show_contact', 'customer_access','totalCost', 'new_show', 'totalCashOut'));
    }

    public function single_customer_data(Request $request){
        $new_single = new SingleData();
        $new_single->name = $request->name;
        $new_single->user_id = Auth::user()->id;
        $new_single->group_id = $request->group_id;
        $new_single->phone = $request->phone;
        $new_single->email = $request->email;
        $new_single->save();
        return redirect()->back()->with('message', 'Single Data add Successfully');
    }


    public function editCustomerData($id){
        $customer_edit = CustomerContact::find($id);
        $customer_access = CustomerAccess::where('user_id', Auth::user()->id)
            ->where('money_status', 1)
            ->orWhere('crm_status', 1)
            ->get();

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

        $show_customer_cash_out = CashOut::where('user_id', Auth::user()->id)->get();
        $cashOut = 0;
        foreach ($show_customer_cash_out as $customer_cash_out){
            $cashOut = ($cashOut + ($customer_cash_out->bank_amount));
        }

        $totalCashOut = $customerCash - $cashOut;

        $totalCost = $customerCash - $customerCampaign;
        return view('customer.group.customer-edit', compact('customer_edit', 'customer_access','totalCashOut', 'totalCost'));
    }

    public function updateCustomerData(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        ]);
        $update_customer = CustomerContact::find($request->id);
        $update_customer->name = $request->name;
        $update_customer->group_id = $request->group_id;
        $update_customer->phone = $request->phone;
        $update_customer->email = $request->email;
        $update_customer->update();
        return redirect('contact/customer/list')->with('message', 'Data Update Successfully');
    }


    public function customer_export()
    {
        return Excel::download(new CustomersExport(), 'customers.xlsx');
    }

    public function customer_import(Request $request)
    {

        $name = $request->input('group_id');
        $file = $request->file('upload_file');
        Excel::import(new CustomersImport($name), $file);
        return back()->with('message', 'Customer Contact File Upload Successfully');
    }

    public function campaignSystem(){
        $customer_access = CustomerAccess::where('user_id', Auth::user()->id)
            ->where('money_status', 1)
            ->orWhere('crm_status', 1)
            ->get();


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

        $show_customer_cash_out = CashOut::where('user_id', Auth::user()->id)->get();
        $cashOut = 0;
        foreach ($show_customer_cash_out as $customer_cash_out){
            $cashOut = ($cashOut + ($customer_cash_out->bank_amount));
        }

        $totalCashOut = $customerCash - $cashOut;


        $totalCost = $customerCash - $customerCampaign;
        $show_low = CampaignLow::where('status', 1)->take(1)->get();
        return view('customer.home.facebook', compact(
            'customer_access',
            'totalCost',
            'show_low',
            'totalCashOut'
        ));
    }

    public function create_customer_fb_marketing()
    {
        $customer_access = CustomerAccess::where('user_id', Auth::user()->id)
            ->where('money_status', 1)
            ->orWhere('crm_status', 1)
            ->get();


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

        $show_customer_cash_out = CashOut::where('user_id', Auth::user()->id)->get();
        $cashOut = 0;
        foreach ($show_customer_cash_out as $customer_cash_out){
            $cashOut = ($cashOut + ($customer_cash_out->bank_amount));
        }

        $totalCashOut = $customerCash - $cashOut;


        $totalCost = $customerCash - $customerCampaign;
        $show_low = CampaignLow::where('status', 1)->take(1)->get();
        return view('customer.facebook.introduction-page', compact('customer_access', 'totalCost', 'show_low', 'totalCashOut'));
    }


    public function customer_campaign_add(Request $request)
    {
        $add_campaign = new CustomerCampaign();
        $add_campaign->start_date = $request->start_date;
        $add_campaign->end_date = $request->end_date;
        $add_campaign->link = $request->link;
        $add_campaign->amount = $request->amount;
        $add_campaign->filtering = $request->filtering;
        $add_campaign->user_id = $request->user_id;
        $add_campaign->save();
        return redirect()->back()->with('message', 'Your Campaign Added');
    }

    public function customer_campaign_manage()
    {
//        $customer_campaign = CustomerCampaign::where('user_id', Auth::user()->id)->get();
//        return $customer_campaign;
        $customer_access = CustomerAccess::where('user_id', Auth::user()->id)
            ->where('money_status', 1)
            ->orWhere('crm_status', 1)
            ->get();


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

        $show_customer_cash_out = CashOut::where('user_id', Auth::user()->id)->get();
        $cashOut = 0;
        foreach ($show_customer_cash_out as $customer_cash_out){
            $cashOut = ($cashOut + ($customer_cash_out->bank_amount));
        }

        $totalCashOut = $customerCash - $cashOut;


        $totalCost = $customerCash - $customerCampaign;
        return view('customer.facebook.campaign-list', compact('customer_campaign_request', 'customer_access','totalCost', 'totalCashOut'));
    }

    public function customer_cashin()
    {
        $customer_cash_in_info = CustomerCashIn::where('user_id', Auth::user()->id)->get();
        $customer_access = CustomerAccess::where('user_id', Auth::user()->id)
            ->where('money_status', 1)
            ->orWhere('crm_status', 1)
            ->get();
        $payment_method = PaymentMethod::where('status', 1)->get();


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


        $show_customer_cash_out = CashOut::where('user_id', Auth::user()->id)->get();
        $cashOut = 0;
        foreach ($show_customer_cash_out as $customer_cash_out){
            $cashOut = ($cashOut + ($customer_cash_out->bank_amount));
        }

        $totalCashOut = $customerCash - $cashOut;

        $totalCost = $customerCash - $customerCampaign;
        return view('customer.cash.cash-in', compact('customer_cash_in_info', 'customer_access', 'payment_method', 'totalCost', 'totalCashOut'));
    }

    public function cashSystem(){
        $customer_cash_in_info = CustomerCashIn::where('user_id', Auth::user()->id)->get();
        $customer_access = CustomerAccess::where('user_id', Auth::user()->id)
            ->where('money_status', 1)
            ->orWhere('crm_status', 1)
            ->get();
        $payment_method = PaymentMethod::where('status', 1)->get();


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


        $show_customer_cash_out = CashOut::where('user_id', Auth::user()->id)->get();
        $cashOut = 0;
        foreach ($show_customer_cash_out as $customer_cash_out){
            $cashOut = ($cashOut + ($customer_cash_out->bank_amount));
        }

        $totalCashOut = $customerCash - $cashOut;

        $totalCost = $customerCash - $customerCampaign;
        return view('customer.home.cash-page', compact(
            'customer_cash_in_info', 'customer_access',
            'payment_method', 'totalCost', 'totalCashOut'));
    }

    public function contactSystem(){

        $customer_cash_in_info = CustomerCashIn::where('user_id', Auth::user()->id)->get();
        $customer_access = CustomerAccess::where('user_id', Auth::user()->id)
            ->where('money_status', 1)
            ->orWhere('crm_status', 1)
            ->get();
        $payment_method = PaymentMethod::where('status', 1)->get();


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


        $show_customer_cash_out = CashOut::where('user_id', Auth::user()->id)->get();
        $cashOut = 0;
        foreach ($show_customer_cash_out as $customer_cash_out){
            $cashOut = ($cashOut + ($customer_cash_out->bank_amount));
        }

        $totalCashOut = $customerCash - $cashOut;

        $totalCost = $customerCash - $customerCampaign;
        return view('customer.home.contact-page', compact(
            'customer_cash_in_info', 'customer_access',
            'payment_method', 'totalCost', 'totalCashOut'));
    }

    public function customer_cashin_request(Request $request)
    {
        $customer_cash_in = new CustomerCashIn();

        if ($request->hasFile('images')) {
            $teamImage = $request->file('images');
            $imageName = $teamImage->getClientOriginalName();
            $fileName = time() . '_files_' . $imageName;
            $directory = public_path('/bank-images/');
            $teamImgUrl = $directory . $fileName;
            Image::make($teamImage)->resize(350, 100)->save($teamImgUrl);
            $customer_cash_in->images = $fileName;
        }

        $customer_cash_in->method_name = $request->method_name;
        $customer_cash_in->payment_method = $request->payment_method;
        $customer_cash_in->note = $request->note;
        $customer_cash_in->amount = $request->amount;
        $customer_cash_in->user_account = $request->user_account;
        $customer_cash_in->user_id = $request->user_id;
        $customer_cash_in->save();
        return redirect()->back()->with('message', 'Your Request Send To Admin');
    }

    public function customer_cashin_delete($id)
    {
        $customer_cash_in_delete = CustomerCashIn::find($id);
        $customer_cash_in_delete->delete();
        return redirect()->back()->with('message', 'Your CashIn Info Deleted');
    }

    public function customer_send_money()
    {
        $customer_access = CustomerAccess::where('user_id', Auth::user()->id)
            ->where('money_status', 1)
            ->orWhere('crm_status', 1)
            ->get();
        $customer_money_send = CustomerSendMoney::where('sender_id', Auth::user()->id)
            ->get();

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

        $show_customer_cash_out = CashOut::where('user_id', Auth::user()->id)->get();
        $cashOut = 0;
        foreach ($show_customer_cash_out as $customer_cash_out){
            $cashOut = ($cashOut + ($customer_cash_out->bank_amount));
        }

        $totalCashOut = $customerCash - $cashOut;

        $totalCost = $customerCash - $customerCampaign;

        return view('customer.cash.send-money', compact('customer_access', 'customer_money_send','totalCost', 'totalCashOut'));
    }

    public function send_money(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required',
            'account_number' => 'required',
            'user_id' => 'required',
        ]);

        $customer_send_money = new CustomerSendMoney();
        $customer_send_money->amount = $request->amount;
        $customer_send_money->user_id = $request->user_id;
        $customer_send_money->sender_id = Auth::user()->id;
        $customer_send_money->account_number = $request->account_number;
        $customer_send_money->save();
        return redirect()->back()->with('message', 'Your Money has been Send Successfully. Please Wait Receiver Confirmation');
    }


    public function customer_cashout_money(){
        $customer_access = CustomerAccess::where('user_id', Auth::user()->id)
            ->where('money_status', 1)
            ->orWhere('crm_status', 1)
            ->get();

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

        // Cash Out Information
        $show_customer_cash_out = CashOut::where('user_id', Auth::user()->id)->get();
        $cashOutbank = 0;
        foreach ($show_customer_cash_out as $customer_cash_out){
            $cashOutbank = ($cashOutbank + ($customer_cash_out->bank_amount));
        }

        $totalCashOut = $customerCash - $cashOutbank;

        $show_customer_mobile_cash = CashOut::where('user_id', Auth::user()->id)->get();
        $mobile = 0;
        foreach ($show_customer_mobile_cash as $send_money){
            $mobile = ($mobile + ($send_money->mobile_amount));
        }

        $totalMobileCash = $customerCash - $mobile;
//        return $totalMobileCash;

//        $totalCost = $customerCash - $customerCampaign;
        //return $totalCost;
        $show_customer_agent_cash = CashOut::where('user_id', Auth::user()->id)->get();
        $agent = 0;
        foreach ($show_customer_agent_cash as $customer_cash_out){
            $agent = ($agent + ($customer_cash_out->agent_amount));
        }

        $totalAgent = $customerCash - $agent;
//        return $totalAgent;


        $show_customer_other_cash = CashOut::where('user_id', Auth::user()->id)->get();
        $other = 0;
        foreach ($show_customer_other_cash as $customer_cash_out){
            $other = ($other + ($customer_cash_out->others_amount));
        }

        $totalOther = $customerCash - $other;
//        return $totalOther;

        // Cash Out Information


        $totalCost = $customerCash - $customerCampaign;

        return view('customer.cash.cash-out', compact('customer_access',
            'show_customer_cash_out',
            'totalCost',
            'totalCashOut',
            'totalOther',
            'totalAgent',
            'totalMobileCash'
            ));

    }

    public function customer_cashout(Request $request){
        $customer_cashout = new CashOut();
        $customer_cashout->user_id = Auth::user()->id;
        $customer_cashout->cash_out_option = $request->cash_out_option;
        $customer_cashout->bank_name = $request->bank_name;
        $customer_cashout->bank_account_number = $request->bank_account_number;
        $customer_cashout->bank_amount = $request->bank_amount;
        $customer_cashout->mobile_bank_name = $request->mobile_bank_name;
        $customer_cashout->mobile_account_number = $request->mobile_account_number;
        $customer_cashout->mobile_amount = $request->mobile_amount;
        $customer_cashout->agent_account_number = $request->agent_account_number;
        $customer_cashout->agent_amount = $request->agent_amount;
        $customer_cashout->others = $request->others;
        $customer_cashout->others_amount = $request->others_amount;
        $customer_cashout->save();
        return redirect()->back()->with('message', 'Your Cash Out Request Send To Admin, Please Wait After Confirmation');
    }



    public function create_customer_sms()
    {
        $customer_access = CustomerAccess::where('user_id', Auth::user()->id)
            ->where('money_status', 1)
            ->orWhere('crm_status', 1)
            ->get();

        $all_group = CustomerGroup::where('user_id', Auth::user()->id)->get();
        $users = CustomerContact::paginate(5);

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

        $show_customer_cash_out = CashOut::where('user_id', Auth::user()->id)->get();
        $cashOut = 0;
        foreach ($show_customer_cash_out as $customer_cash_out){
            $cashOut = ($cashOut + ($customer_cash_out->bank_amount));
        }

        $totalCashOut = $customerCash - $cashOut;

        $totalCost = $customerCash - $customerCampaign;

        return view('customer.sms.create', compact('customer_access', 'all_group', 'users','totalCost', 'totalCashOut'));
    }


//    Customer SMS System

    public function sendSystem(){
        $customer_access = CustomerAccess::where('user_id', Auth::user()->id)
            ->where('money_status', 1)
            ->orWhere('crm_status', 1)
            ->get();

        $all_group = CustomerGroup::where('user_id', Auth::user()->id)->get();
        $users = CustomerContact::paginate(5);

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

        $show_customer_cash_out = CashOut::where('user_id', Auth::user()->id)->get();
        $cashOut = 0;
        foreach ($show_customer_cash_out as $customer_cash_out){
            $cashOut = ($cashOut + ($customer_cash_out->bank_amount));
        }

        $totalCashOut = $customerCash - $cashOut;

        $totalCost = $customerCash - $customerCampaign;
        return view('customer.home.sms-page', compact('customer_access', 'all_group', 'users','totalCost', 'totalCashOut'));
    }
    public function sms_customer(Request $request)
    {


        $new_sms = new CustomerSMS();
        $new_sms->number = $request->number;
        $new_sms->message = $request->message;
        $new_sms->user_id = Auth::user()->id;
        $new_sms->save();

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


    public function group_customer_sms(Request $request)
    {
        $user_number = $request->number;
        $number = implode(",", $user_number);
//        return $number;

        // Register your ip first. To do that, contact bpl personnel
        $url = 'http://banglakingssoft.powersms.net.bd/httpapi/sendsms';

        $fields = array(
            'userId' => urlencode('banglakings'),
            'password' => urlencode('bksoft2018'),
            'smsText' => urlencode('This is a sample sms text.'),
            'commaSeperatedReceiverNumbers' => $number
        );

        $fields_string = '';
        foreach ($fields as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }

        rtrim($fields_string, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($ch);

        if ($result === false) {
            echo sprintf('<span>%s</span>CURL error:', curl_error($ch));
            return;
        }

        $json_result = json_decode($result);
        var_dump($json_result);

        if ($json_result->isError) {
            echo sprintf("<p style='color:red'>ERROR: <span style='font-weight:bold;'>%s</span></p>", $json_result->message);
        } else {
            echo sprintf("<p style='color:green;'>SUCCESS!</p>");
        }

        curl_close($ch);

        return redirect()->back()->with('message', 'Your Message Send Your Customer');
    }


    public function send_sms_customer_list()
    {
        $customer_access = CustomerAccess::where('user_id', Auth::user()->id)
            ->where('money_status', 1)
            ->orWhere('crm_status', 1)
            ->get();
        $customer_sms_list = CustomerSMS::where('user_id', Auth::user()->id)->get();

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

        $show_customer_cash_out = CashOut::where('user_id', Auth::user()->id)->get();
        $cashOut = 0;
        foreach ($show_customer_cash_out as $customer_cash_out){
            $cashOut = ($cashOut + ($customer_cash_out->bank_amount));
        }

        $totalCashOut = $customerCash - $cashOut;

        $totalCost = $customerCash - $customerCampaign;

        return view('customer.sms.send-list', compact('customer_access', 'customer_sms_list','totalCost', 'totalCashOut'));
    }

    public function send_sms_customer_group()
    {
        $customer_access = CustomerAccess::where('user_id', Auth::user()->id)
            ->where('money_status', 1)
            ->orWhere('crm_status', 1)
            ->get();
        $users = CustomerContact::where('group_id', Auth()->user()->id)->get();

        $all_group = CustomerGroup::where('user_id', Auth::user()->id)->get();
//        return $users;

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

        $show_customer_cash_out = CashOut::where('user_id', Auth::user()->id)->get();
        $cashOut = 0;
        foreach ($show_customer_cash_out as $customer_cash_out){
            $cashOut = ($cashOut + ($customer_cash_out->bank_amount));
        }

        $totalCashOut = $customerCash - $cashOut;

        $totalCost = $customerCash - $customerCampaign;

        return view('customer.sms.group-sms', compact('customer_access', 'users', 'all_group','totalCost', 'totalCashOut'));
    }

    public function group_mail(Request $request)
    {
//

        $users = CustomerContact::all();
        $all_mail = $users->pluck('email')->toArray();

        $save_mail = new GroupMailStore();
        $save_mail->message = $request->message;
        $save_mail->save();
        Session::put('message', $save_mail->message);

        Mail::send('customer.mail.email', $all_mail, function ($message) use ($all_mail) {
            $message->to($all_mail)->subject('Hello group');
//            $mail->notify(new GroupMail());
//        Notification::send($users, new GroupMail());

        });



        return redirect()->back()->with('message', 'Group Mail Send Successfully');

    }

    public function sendSmsMulti(Request $request)
    {
        $url = 'http://banglakingssoft.powersms.net.bd/httpapi/sendsms';

        $comma_separated = implode(",", $request->number);

        $fields = array(
            'userId' => urlencode('banglakings'),
            'password' => urlencode('bksoft2018'),
            'smsText' => urlencode($request->input('group_message')),
            'commaSeperatedReceiverNumbers' => $comma_separated,
        );
        $fields_string = '';
        foreach ($fields as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }
        rtrim($fields_string, '&');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

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
        return redirect()->back()->with('message', 'Your Message Send Your Customer');
    }

    public function sendSmsView(Request $get){
        $id = $get->id;
        $viewSMS = CustomerContact::find($id);
        return $viewSMS;
    }

    public function user_id(Request $request){
        $account_id = User::where('account_number', $request->account_number)->get();
        return $account_id;
    }

    public function method_option(Request $request){
        $method_show = PaymentMethod::where('id', $request->id)->get();
        return $method_show;
    }

    public function customer_access(){
        $customer_access = CustomerAccess::where('user_id', Auth::user()->id)->get();

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

        $show_customer_cash_out = CashOut::where('user_id', Auth::user()->id)->get();
        $cashOut = 0;
        foreach ($show_customer_cash_out as $customer_cash_out){
            $cashOut = ($cashOut + ($customer_cash_out->bank_amount));
        }

        $totalCashOut = $customerCash - $cashOut;


        $totalCost = $customerCash - $customerCampaign;

        return view('customer.customer-access', compact(  'customer_access','totalCost', 'totalCashOut'));
    }

    public function need_customer_access(Request $request){

        $this->validate($request,[
            'full_name' => 'required',
            'phone' => 'required|max:15|min:11|unique:customer_accesses',
            'second_phone' => 'required|max:15|min:11|unique:customer_accesses',
            'nationality' => 'required|unique:customer_accesses',
            'address' => 'required',
            'country' => 'required',
        ]);

        $customer_access = new CustomerAccess();
        $customer_access->user_id = Auth::user()->id;
        $customer_access->money_transfer = $request->money_transfer;
        $customer_access->crm = $request->crm;
        $customer_access->full_name = $request->full_name;
        $customer_access->email = Auth::user()->email;
        $customer_access->phone = $request->phone;
        $customer_access->second_phone = $request->second_phone;
        $customer_access->nationality = $request->nationality;
        $customer_access->ac_number = $request->ac_number;
        $customer_access->address = $request->address;
        $customer_access->country = $request->country;
        $customer_access->tin_number = $request->tin_number;
        $customer_access->nominee = $request->nominee;
        $customer_access->cd = $request->cd;
        $customer_access->sd = $request->sd;
        $customer_access->usd = $request->usd;
        $customer_access->bdt = $request->bdt;
        $customer_access->eur = $request->eur;
        $customer_access->inr = $request->inr;
        $customer_access->aed = $request->aed;
        $customer_access->save();
        return redirect()->back()->with('message', 'Access Request Send Wait for Confirmation');
    }

    public function customer_setting(){
        $customer_access = CustomerAccess::where('user_id', Auth::user()->id)->get();

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

        $show_customer_cash_out = CashOut::where('user_id', Auth::user()->id)->get();
        $cashOut = 0;
        foreach ($show_customer_cash_out as $customer_cash_out){
            $cashOut = ($cashOut + ($customer_cash_out->bank_amount));
        }

        $totalCashOut = $customerCash - $cashOut;


        $totalCost = $customerCash - $customerCampaign;
        return view('customer.home.settings', compact('customer_access', 'totalCost', 'totalCashOut'));
    }

    public function edit_profile($id){
        $edit_settings = CustomerAccess::find($id);
        $customer_access = CustomerAccess::where('user_id', Auth::user()->id)->get();

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

        $show_customer_cash_out = CashOut::where('user_id', Auth::user()->id)->get();
        $cashOut = 0;
        foreach ($show_customer_cash_out as $customer_cash_out){
            $cashOut = ($cashOut + ($customer_cash_out->bank_amount));
        }

        $totalCashOut = $customerCash - $cashOut;

        $totalCost = $customerCash - $customerCampaign;
        return view('customer.home.edit-profile', compact('edit_settings','customer_access','totalCost', 'totalCashOut'));
    }

    public function update_profile(Request $request){
        $update_setting = CustomerAccess::find($request->id);
        $update_setting->full_name = $request->full_name;
        $update_setting->email = $request->email;
        $update_setting->phone = $request->phone;
        $update_setting->second_phone = $request->second_phone;
        $update_setting->nationality = $request->nationality;
        $update_setting->ac_number = $request->ac_number;
        $update_setting->address = $request->address;
        $update_setting->tin_number = $request->tin_number;
        $update_setting->nominee = $request->nominee;
        $update_setting->update();
        return redirect('/setting/option')->with('message', 'Your Profile has been updated');
    }


    public function customer_registration(){
        $show_history = Chat::all();

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

        $show_customer_cash_out = CashOut::where('user_id', Auth::user()->id)->get();
        $cashOut = 0;
        foreach ($show_customer_cash_out as $customer_cash_out){
            $cashOut = ($cashOut + ($customer_cash_out->bank_amount));
        }

        $totalCashOut = $customerCash - $cashOut;


        $totalCost = $customerCash - $customerCampaign;
        $customer_access = CustomerAccess::where('user_id', Auth::user()->id)->get();
        return view('customer.reg.registration', compact('show_history', 'totalCost','customer_access', 'totalCashOut'));
    }
}
