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
                                    <a href="{{url('/create/mail')}}"><img src="{{ asset('assets/') }}/email-icon (1).png" height="120" width="120"/></a>
                                    <br/>
                                    <br/>
                                    <a href="{{url('/create/mail')}}" style="color: red; font-weight: bold;">Create Mail</a>
                                </td>
                                <td>
                                    <a href="#"><img src="{{ asset('assets/') }}/emailus.jpg" height="120" width="120"/></a>
                                    <br/>
                                    <br/>
                                    <a href="#" style="color: red; font-weight: bold;">Inbox Mail</a>
                                </td>
                                <td>
                                    <a href="{{url('/send/list')}}"><img src="{{ asset('assets/') }}/images.png" height="120" width="120"/></a>
                                    <br/>
                                    <br/>
                                    <a href="{{url('/send/list')}}" style="color: red; font-weight: bold;">Send Mail</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
