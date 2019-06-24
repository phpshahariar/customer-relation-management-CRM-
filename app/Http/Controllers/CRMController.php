<?php

namespace App\Http\Controllers;

use App\Chat;
use App\CustomerAccess;
use App\CustomerCampaign;
use App\CustomerCashIn;
use Illuminate\Http\Request;
use Auth;
class CRMController extends Controller
{
    public function customer_chating(Request $request){
        $this->validate($request,[
            'chating' => 'required',
        ]);
        $customer_chating = new Chat();
        $customer_chating->chating = $request->chating;
        $customer_chating->user_id = Auth::user()->id;
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
        return view('customer.reg.customer-info', compact('totalCost','customer_access'));
    }
}
