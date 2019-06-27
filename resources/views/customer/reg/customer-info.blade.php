@extends('customer.master')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-9 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4>Customer Service Form</h4>
                        @if($message = Session::get('message'))
                            <b class="alert alert-success">{{$message}}</b>
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/save/customer/information') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label>Full Name : </label>
                                    <input type="text" class="form-control" name="name" placeholder="First name">
                                    <span style="color: red"> {{ $errors->has('name') ? $errors->first('name') : ' ' }}</span>
                                </div>
                                <div class="col">
                                    <label>Company Name : </label>
                                    <input type="text" class="form-control" name="company_name" placeholder="Company name">
                                    <span style="color: red"> {{ $errors->has('company_name') ? $errors->first('company_name') : ' ' }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Phone : </label>
                                    <input type="text" class="form-control" name="phone" placeholder="Phone Number">
                                    <span style="color: red"> {{ $errors->has('phone') ? $errors->first('phone') : ' ' }}</span>
                                </div>
                                <div class="col">
                                    <label>Email : </label>
                                    <input type="text" class="form-control" name="email_address" placeholder="Enter Your mail...">
                                    <span style="color: red"> {{ $errors->has('email_address') ? $errors->first('email_address') : ' ' }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>District : </label>
                                    <select class="form-control" name="district">
                                        <option>---Select District---</option>
                                        <option value="1">Dhaka</option>
                                        <option value="2">Chittagong</option>
                                        <option value="3">Rangpur</option>
                                    </select>
                                    <span style="color: red"> {{ $errors->has('district') ? $errors->first('district') : ' ' }}</span>
                                </div>
                                <div class="col">
                                    <label>Area : </label>
                                    <select class="form-control" name="area">
                                        <option>---Select Area---</option>
                                        <option value="1">Dhanmondi</option>
                                        <option value="2">Hathazari</option>
                                        <option value="3">Dinajpur</option>
                                    </select>
                                    <span style="color: red"> {{ $errors->has('area') ? $errors->first('area') : ' ' }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Address : </label>
                                    <textarea class="form-control" name="address"></textarea>
                                    <span style="color: red"> {{ $errors->has('address') ? $errors->first('address') : ' ' }}</span>
                                </div>
                                <div class="col">
                                    <label>Service : </label>
                                    <input type="text" name="service" class="form-control" placeholder="Enter Your Service">
                                    <span style="color: red"> {{ $errors->has('service') ? $errors->first('service') : ' ' }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Notes : </label>
                                    <textarea class="form-control" name="notes"></textarea>
                                    <span style="color: red"> {{ $errors->has('notes') ? $errors->first('notes') : ' ' }}</span>
                                </div>
                                <div class="col">
                                    <label>Customer By : </label>
                                    <input type="text" name="customer_by" class="form-control" placeholder="Customer By....">
                                    <span style="color: red"> {{ $errors->has('customer_by') ? $errors->first('customer_by') : ' ' }}</span>
                                </div>
                            </div>
{{--                            <div class="row">--}}
{{--                                <div class="col">--}}
{{--                                    <label>Date : </label>--}}
{{--                                    <input type="date" name="create_date" class="form-control">--}}
{{--                                </div>--}}
{{--                                <div class="col">--}}
{{--                                    <label>Created By : </label>--}}
{{--                                    <input type="text" name="user_id" class="form-control" readonly value="{{ Auth::user()->id }}">--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <br/>
                            <input type="submit" name="btn" class="btn btn-success btn-block" readonly value="SubmiT">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


{{--    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>--}}




@endsection