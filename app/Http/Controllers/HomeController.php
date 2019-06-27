<?php

namespace App\Http\Controllers;

use App\CashOut;
use App\CustomerAccess;
use App\CustomerCampaign;
use App\CustomerCashIn;
use Illuminate\Http\Request;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
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

//        return $customerCash;

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

        $totalCost = $customerCash - $customerCampaign;
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

        $customer_access = CustomerAccess::where('user_id', Auth::user()->id)
            ->where('money_status', 1)
            ->orWhere('crm_status', 1)
            ->get();

        return view('customer.home.index', compact('customerCash', 'totalCost', 'customer_access', 'totalCashOut', 'totalMobileCash', 'totalAgent', 'totalOther'));
    }
}
