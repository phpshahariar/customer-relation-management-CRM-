@extends('customer.master')

@section('content')

    <div class="container">
        <div class="card mb-3">
            @if(Session::get('message'))
                <h5 style="text-align: center;" class="alert alert-success">{!! Session::get('message') !!}</h5>
            @endif
            <div class="card-header">
                <i class="fas fa-table"></i>
                CRM List</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr style="text-align: center;">
                            <th width="5%">SL NO</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($show_crm as $key => $show)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $show->name }}</td>
                                    <td>{{ $show->email_address }}</td>
                                    <td>{{ $show->phone }}</td>
                                    <td style="text-align: center;">
                                        <a href="{{ url('/get/profile/'.$show->id) }}" target="_blank" class="badge badge-success">Profile</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection