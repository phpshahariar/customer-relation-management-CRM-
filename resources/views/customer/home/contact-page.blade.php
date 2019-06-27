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
                                    <a href="{{ url('/create/customer/group') }}"><img src="{{ asset('assets/') }}/add_user_group-512.png" height="120" width="120"/></a>
                                    <br/>
                                    <br/>
                                    <a href="{{ url('/create/customer/group') }}" style="color: red; font-weight: bold;">Create Group</a>
                                </td>
                                <td>
                                    <a href="{{url('/contact/customer/list')}}"><img src="{{ asset('assets/') }}/open-512.png" height="120" width="120"/></a>
                                    <br/>
                                    <br/>
                                    <a href="{{url('/contact/customer/list')}}" style="color: red; font-weight: bold;">Upload Group File</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
