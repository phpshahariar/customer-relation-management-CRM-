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
                                    <a href="{{url('/customer/facebook/boost')}}"><img src="{{ asset('assets/') }}/fbcreate.png" height="120" width="120"/></a>
                                    <br/>
                                    <br/>
                                    <a href="{{url('/customer/facebook/boost')}}" style="color: red; font-weight: bold;">Create Campaign</a>
                                </td>
                                <td>
                                    <a href="{{ url('/customer/manage/campaign') }}"><img src="{{ asset('assets/') }}/Social-Media-Marketing-NJ.png" height="120" width="120"/></a>
                                    <br/>
                                    <br/>
                                    <a href="{{ url('/customer/manage/campaign') }}" style="color: red; font-weight: bold;">Manage Campaign</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
