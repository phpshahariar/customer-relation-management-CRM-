@extends('customer.home.apps')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <nav class="navbar navbar-expand-md navbar-light bg-danger shadow-sm" style="display: block;">
                        <div class="container">
                            <a class="navbar-brand" style="color: #ffffff;">
                                A/C : {{ Auth::user()->account_number }}
                            </a>
                            <a class="navbar-brand" style="color: #ffffff;">
                                @if($totalCost)
                                    Total : {{ number_format($totalCost,2) }} Tk.
                                @elseif($totalCashOut)
                                    Total : 0.00 Tk.
                                @endif
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <!-- Left Side Of Navbar -->
                                <ul class="navbar-nav mr-auto">

                                </ul>

                                <!-- Right Side Of Navbar -->
                                <ul class="navbar-nav ml-auto">
                                    <!-- Authentication Links -->
                                    @guest
                                        {{--                            <li class="nav-item">--}}
                                        {{--                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
                                        {{--                            </li>--}}
                                        {{--                            @if (Route::has('register'))--}}
                                        {{--                                <li class="nav-item">--}}
                                        {{--                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
                                        {{--                                </li>--}}
                                        {{--                            @endif--}}
                                    @else
                                        <li class="nav-item dropdown">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                <b style="color: white;">{{ Auth::user()->name }}</b> <span class="caret"></span>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </div>
                                        </li>
                                    @endguest
                                </ul>
                            </div>
                        </div>
                    </nav>
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
                                    <a href="#"><img src="{{ asset('assets/') }}/Facebook-sticker.png" height="120" width="120"/></a>
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
                                            <a href="#"><img src="{{ asset('assets/') }}/best-transfer-amount-guarantee-mob.png" height="120" width="120"/></a>
                                            <br/>
                                            <br/>
                                            <a href="#" style="color: red; font-weight: bold;">Money Transfer</a>
                                        </td>
                                        @else
                                        <td>
                                            <img src="{{ asset('assets/') }}/best-transfer-amount-guarantee-mob.png" height="120" width="120"/>
                                        </td>
                                    @endif
                                @endforeach

                                <td>
                                    <a href="#"><img src="{{ asset('assets/') }}/crm.png" height="120" width="120"/></a>
                                    <br/>
                                    <br/>
                                    <a href="#" style="color: red; font-weight: bold;">CRM</a>
                                </td>
                            </tr>
                            <tr style="text-align: center;">
                                <td>
                                    <a href="#"><img src="{{ asset('assets/') }}/bump-pay-300.png" height="120" width="120"/></a>
                                    <br/>
                                    <br/>
                                    <a href="#" style="color: red; font-weight: bold;">CashIn</a>
                                </td>
                                <td>
                                    <a href="#"><img src="{{ asset('assets/') }}/Icon.png" height="120" width="120"/></a>
                                    <br/>
                                    <br/>
                                    <a href="#" style="color: red; font-weight: bold;">Contact List</a>
                                </td>
                                <td>
                                    <a href="#"><img src="{{ asset('assets/') }}/access.png" height="120" width="120"/></a>
                                    <br/>
                                    <br/>
                                    <a href="#" style="color: red; font-weight: bold;">Access Power</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
