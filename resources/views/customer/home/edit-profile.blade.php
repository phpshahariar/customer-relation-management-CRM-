@extends('customer.master')
@section('content')
    <div class="container">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 style="margin-left: 200px;">Update Profile Setting</h5>
                </div>
                <div class="card-body">
                    <form action="{{ url('/update/setting') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $edit_settings->id }}">
                        <div class="row">
                            <div class="col">
                                <label> Full Name : </label>
                                <input type="text" required name="full_name" class="form-control" value="{{ $edit_settings->full_name }}">
                            </div>
                            <div class="col">
                                <label> Your Email : </label>
                                <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label> Personal Phone Number : </label>
                                <input type="number" required name="phone" class="form-control" value="{{ $edit_settings->phone }}">
                            </div>
                            <div class="col">
                                <label> Emergency Phone Number : </label>
                                <input type="number" required name="second_phone" class="form-control" value="{{ $edit_settings->second_phone }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label> Passport/NIT/DOB : </label>
                                <input type="text" required name="nationality" class="form-control" value="{{ $edit_settings->nationality }}">
                                <p>Example : Passport no XXXXXXXXX</p>
                            </div>
                            <div class="col">
                                <label> Account Number : </label>
                                <input type="number" name="ac_number"  class="form-control" value="{{ Auth::user()->account_number }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label> Address : </label>
                                <textarea required name="address" class="form-control">{{ $edit_settings->address }}</textarea>
                            </div>
                            <div class="col">
                                <label> Password : </label>
                                <input type="text" name="password" required  class="form-control" value="{{ Auth::user()->password }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label> TIN Number : </label>
                                <input type="number"  name="tin_number" class="form-control" value="{{ $edit_settings->tin_number }}">
                            </div>
                            <div class="col">
                                <label> Nominee Name: </label>
                                <input type="text" name="nominee"  class="form-control" value="{{ $edit_settings->nominee }}">
                            </div>
                        </div>
                        <br/>
                        <input type="submit" class="btn btn-block btn-success" value="Update Profile">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection