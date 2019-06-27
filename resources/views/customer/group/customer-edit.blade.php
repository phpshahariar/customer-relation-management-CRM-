@extends('customer.master')

@section('content')
    <div class="container">
        <div class="col-md-9 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <h4>Edit Customer Information</h4>
                    </div>
                    <form action="{{url('/update/customer/data')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" class="form-control" value="{{ $customer_edit->id }}">
                        <div class="form-group">
                            <input type="hidden" name="group_id" class="form-control" value="{{ $customer_edit->group_id }}">
                        </div>
                        <div class="form-group">
                            <label>Name : </label>
                            <input type="text" name="name" class="form-control" value="{{ $customer_edit->name }}">
                        </div>
                        <div class="form-group">
                            <label>Phone : </label>
                            <input type="text" name="phone" class="form-control" value="{{ $customer_edit->phone }}">
                        </div>
                        <div class="form-group">
                            <label>Email : </label>
                            <input type="text" name="email" class="form-control" value="{{ $customer_edit->email }}">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="btn" class="btn btn-primary btn-block">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection