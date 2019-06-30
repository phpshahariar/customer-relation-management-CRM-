
@extends('customer.master')

@section('content')

    <div class="container-fluid">

        <!-- Breadcrumbs-->
{{--        <ol class="breadcrumb">--}}
{{--            <li class="breadcrumb-item">--}}
{{--                <h3 style="color: red;">Account Number is : {{ Auth::user()->account_number }}</h3>--}}
{{--            </li>--}}
{{--        </ol>--}}

        <!-- Icon Cards-->
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-primary o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-fw fa-comments"></i>
                        </div>
                        <div class="mr-5">Info Here</div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="#">
                        <span class="float-left">View Details</span>
                        <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-warning o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-fw fa-list"></i>
                        </div>
                        <div class="mr-5">Info Here</div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="#">
                        <span class="float-left">View Details</span>
                        <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-success o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-fw fa-shopping-cart"></i>
                        </div>
                        <div class="mr-5">Info Here</div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="#">
                        <span class="float-left">View Details</span>
                        <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-danger o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-fw fa-life-ring"></i>
                        </div>
                        @if($totalCashOut > 0)
                            <div class="mr-5 badge badge-success">Total : {{ number_format($totalCashOut,2) }} Tk.</div>
                        @else
                            <div class="mr-5 badge badge-success">
                                Total : 0.00 Tk.
                            </div>
                        @endif
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="#">
                        <span class="float-left">View Details</span>
                        <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-borderless">
                <tr style="text-align: center;">
                    <td>
                        <a href="{{url('/sms/system')}}"><img src="{{ asset('assets/') }}/sms-53-519940.png" height="120" width="120"/></a>
                        <br/>
                        <br/>
                        <a href="{{url('/sms/system')}}" style="color: red; font-weight: bold;">SMS Syatem</a>
                    </td>
                    <td>
                        <a href="{{url('/email/system')}}"><img src="{{ asset('assets/') }}/Email-icon.png" height="120" width="120"/></a>
                        <br/>
                        <br/>
                        <a href="{{url('/email/system')}}" style="color: red; font-weight: bold;">Email System</a>
                    </td>
                    <td>
                        <a href="{{url('/campaign/system')}}"><img src="{{ asset('assets/') }}/Facebook-sticker.png" height="120" width="120"/></a>
                        <br/>
                        <br/>
                        <a href="#" style="color: red; font-weight: bold;">Facebook Campaign</a>
                    </td>
                </tr>
                <tr style="text-align: center;">
                    <td>
                        <a href="#"><img src="{{ asset('assets/') }}/1200x630bb.png" height="120" width="120"/></a>
                        <br/>
                        <br/>
                        <a href="#" style="color: red; font-weight: bold;">Voice SMS</a>
                    </td>
                    @foreach($customer_access as $access)
                        @if($access->money_status == 1)
                            <td>
                                <a href="{{url('/cash/system')}}"><img src="{{ asset('assets/') }}/best-transfer-amount-guarantee-mob.png" height="120" width="120"/></a>
                                <br/>
                                <br/>
                                <a href="{{url('/cash/system')}}" style="color: red; font-weight: bold;">Money Transfer</a>
                            </td>
                        @else
                            <td>
                                <img src="{{ asset('assets/') }}/best-transfer-amount-guarantee-mob.png" height="120" width="120"/>
                            </td>
                        @endif
                    @endforeach
                    @foreach($customer_access as $access)
                        @if($access->crm_status == 1)
                    <td>
                        <a href="#"><img src="{{ asset('assets/') }}/crm.png" height="120" width="120"/></a>
                        <br/>
                        <br/>
                        <a href="#" style="color: red; font-weight: bold;">CRM</a>
                    </td>
                        @else
                            <td>
                                <img src="{{ asset('assets/') }}/crm.png" height="120" width="120"/>
                            </td>
                        @endif
                    @endforeach
                </tr>
                <tr style="text-align: center;">
                    <td>
                        <a href="{{url('/cashin/request')}}"><img src="{{ asset('assets/') }}/bump-pay-300.png" height="120" width="120"/></a>
                        <br/>
                        <br/>
                        <a href="{{url('/cashin/request')}}" style="color: red; font-weight: bold;">CashIn</a>
                    </td>
                    <td>
                        <a href="{{url('/contact/system')}}"><img src="{{ asset('assets/') }}/Icon.png" height="120" width="120"/></a>
                        <br/>
                        <br/>
                        <a href="{{url('/contact/system')}}" style="color: red; font-weight: bold;">Contact List</a>
                    </td>
                    <td>
                        <a href="{{ url('/customer/access') }}"><img src="{{ asset('assets/') }}/access.png" height="120" width="120"/></a>
                        <br/>
                        <br/>
                        <a href="{{ url('/customer/access') }}" style="color: red; font-weight: bold;">Access Power</a>
                    </td>
                </tr>
            </table>
        </div>

    </div>

    @endsection