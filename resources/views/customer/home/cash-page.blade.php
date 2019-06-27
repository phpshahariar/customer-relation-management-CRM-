@extends('customer.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr style="text-align: center;">
                                <td>
                                    <a href="{{url('/cashin/request')}}"><img src="{{ asset('assets/') }}/email-icon (1).png" height="120" width="120"/></a>
                                    <br/>
                                    <br/>
                                    <a href="{{url('/cashin/request')}}" style="color: red; font-weight: bold;">CashIn</a>
                                </td>
                                <td>
                                    <a href="{{url('/send/money')}}"><img src="{{ asset('assets/') }}/send.png" height="120" width="120"/></a>
                                    <br/>
                                    <br/>
                                    <a href="{{url('/send/money')}}" style="color: red; font-weight: bold;">Send Money</a>
                                </td>
                                <td>
                                    <a href="{{url('/cash/out/money')}}"><img src="{{ asset('assets/') }}/bump-pay-300.png" height="120" width="120"/></a>
                                    <br/>
                                    <br/>
                                    <a href="{{url('/cash/out/money')}}" style="color: red; font-weight: bold;">Cash Out</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
