@extends('customer.master')

@section('content')

    <div class="container">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Alert List</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr style="text-align: center;">
                            <th>Date</th>
                            <th>Customer_Name</th>
                            <th>Created_Name</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($alert_list as $key => $list)
                                <tr>
                                    <td>{{ $list->alert_date }}</td>
                                    <td>{{ $list->customer_name->name }}</td>
                                    <td>{{ $list->user_name->name }}</td>
                                    <td>{!! substr($list->message,0,120) !!}</td>
                                    <td width="12%">
                                    @if($list->status == 1)
                                        <p class="btn btn-success disabled">Clear Alert</p>
                                    @else
                                        <a href="{{ url('/pending/alert/'.$list->id) }}" class="btn btn-warning">Pending</a>
                                    @endif
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