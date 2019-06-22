@extends('admin.master')

@section('content')
    <div class="container">

        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Customer List</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr style="text-align: center;">
                            <th width="10%">SL NO</th>
                            <th>Customer Name</th>
                            <th>Customer Email</th>
                            <th>Customer Account No</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customer_list as $key => $list)
                            <tr style="text-align: center;">
                                <td>{{ $key }}</td>
                                <td>{!! $list->name !!}</td>
                                <td>{!! $list->email !!}</td>
                                <td>{!! $list->account_number !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
