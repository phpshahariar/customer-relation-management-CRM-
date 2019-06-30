<?php

namespace App\Http\Controllers;

use App\CashOut;
use App\CategoryPage;
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
        $pages = CategoryPage::where('status', 1)->get();
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
        $show_customer_cash_out = CashOut::where('user_id', Auth::user()->id)
            ->where('status', 2)
            ->get();
        $cashOutMoney = 0;
        foreach ($show_customer_cash_out as $customer_cash_out){
            $cashOutMoney = ($cashOutMoney + ($customer_cash_out->amount));
        }

        $totalCashOut = $customerCash - $cashOutMoney;

//        return $totalOther;

    // Cash Out Information

        $customer_access = CustomerAccess::where('user_id', Auth::user()->id)
            ->where('money_status', 1)
            ->orWhere('crm_status', 1)
            ->get();

        return view('customer.home.index', compact('customerCash',
            'customer_access', 'totalCashOut', 'pages'));
    }
}
