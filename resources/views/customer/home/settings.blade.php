@extends('customer.master')

@section('content')
    <div class="container">
        @if(Session::get('message'))
            <b class="alert alert-success">{{ Session::get('message') }}</b>
        @endif
        <div class="col-md-8 mx-auto" style="border: 0px solid red; margin-top: 80px;">
            <div class="card-header bg-danger">
                <h4 style="margin-left: 200px;">Your Setting Option</h4>
            </div>
            <div class="card">
                    @foreach($customer_access as $key => $setting)
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>
                                        <label>Name : </label>
                                        <b>{!! $setting->full_name !!}</b>
                                    </td>
                                    <td>
                                        <label>Email : </label>
                                        <b>{{ Auth::user()->email }}</b>
                                    </td>
                                    <td>
                                        <label>Phone : </label>
                                        <b>{!! $setting->phone !!}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Passport/NID/DOB : </label>
                                        <b>{!! $setting->nationality !!}</b>
                                    </td>
                                    <td>
                                        <label>Nominee : </label>
                                        <b>{!! $setting->nominee !!}</b>
                                    </td>
                                    <td>
                                        <label>TIN Number : </label>
                                        <b>{!! $setting->tin_number !!}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Address : </label>
                                        <b>{!! $setting->address !!}</b>
                                    </td>
                                    <td>
                                        <label>Secondary Phone: </label>
                                        <b>{!! $setting->second_phone !!}</b>
                                    </td>
                                    <td>
                                        <label>Account Number : </label>
                                        <b>{!! Auth::user()->account_number !!}</b>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="{{ url('/edit/profile/'.$setting->id) }}" class="btn btn-block btn-primary">Edit Profile</a>
                    @endforeach
            </div>
        </div>
    </div>
@endsection
