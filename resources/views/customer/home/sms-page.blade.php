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
                                    <a href="{{url('/create/customer/sms')}}"><img src="{{ asset('assets/') }}/sms-53-519940.png" height="120" width="120"/></a>
                                    <br/>
                                    <br/>
                                    <a href="{{url('/create/customer/sms')}}" style="color: red; font-weight: bold;">Create SMS</a>
                                </td>
                                <td>
                                    <a href="#"><img src="{{ asset('assets/') }}/images.png" height="120" width="120"/></a>
                                    <br/>
                                    <br/>
                                    <a href="#" style="color: red; font-weight: bold;">Inbox SMS</a>
                                </td>
                                <td>
                                    <a href="{{url('/send/customer/sms/list')}}"><img src="{{ asset('assets/') }}/send.png" height="120" width="120"/></a>
                                    <br/>
                                    <br/>
                                    <a href="{{url('/send/customer/sms/list')}}" style="color: red; font-weight: bold;">Send SMS</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
