@extends('customer.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4>Customer Service Form</h4>
                    </div>
                    <div class="card-body">
                        <form>
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label>Full Name : </label>
                                    <input type="text" class="form-control" name="name" placeholder="First name">
                                </div>
                                <div class="col">
                                    <label>Company Name : </label>
                                    <input type="text" class="form-control" name="company_name" placeholder="Company name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Phone : </label>
                                    <input type="text" class="form-control" name="phone" placeholder="Phone Number">
                                </div>
                                <div class="col">
                                    <label>Email : </label>
                                    <input type="text" class="form-control" name="email_address" placeholder="Enter Your mail...">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>District : </label>
                                    <select class="form-control" name="district">
                                        <option>---Select District---</option>
                                        <option>All District</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label>Area : </label>
                                    <select class="form-control" name="district">
                                        <option>---Select Area---</option>
                                        <option>All Area</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Address : </label>
                                    <textarea class="form-control" name="address"></textarea>
                                </div>
                                <div class="col">
                                    <label>Service : </label>
                                    <input type="text" name="service" class="form-control" placeholder="Enter Your Service">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Notes : </label>
                                    <textarea class="form-control" name="notes"></textarea>
                                </div>
                                <div class="col">
                                    <label>Customer By : </label>
                                    <input type="text" name="customer_by" class="form-control" placeholder="Customer By....">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Date : </label>
                                    <input type="date" name="create_date" class="form-control">
                                </div>
                                <div class="col">
                                    <label>Created By : </label>
                                    <input type="text" name="created_by" class="form-control" readonly value="{{ Auth::user()->name }}">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection