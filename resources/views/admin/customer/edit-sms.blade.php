@extends('admin.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="col-md-8">

                    <form action="{{ url('/update/sms/fee') }}" method="post" class="mx-auto">
                        @csrf
                        <label>Select Service</label>
                        <input type="text" name="id" id="id" value="{!! $edit_sms->id !!}" class="form-control" placeholder="service">
                        <div class="form-group">
                            <input type="text" name="serviceFee" value="{!! $edit_sms->serviceFee !!}" class="form-control" placeholder="service">
                        </div>
                        <div class="form-group">
                            <label>Service Price : </label>
                            <input type="text" name="price" value="{!! $edit_sms->price !!}" class="form-control" placeholder="Price">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="btn" class="btn btn-primary btn-block">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection