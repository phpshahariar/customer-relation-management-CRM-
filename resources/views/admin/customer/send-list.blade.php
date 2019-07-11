@extends('admin.master')

@section('content')
    <div class="container">

        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Customer Send Money List</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr style="text-align: center;">
                            <th width="10%">SL NO</th>
                            <th>Sender Account</th>
                            <th>Receiver Account</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($customer_send_money as $key => $send_money)
                                <tr style="text-align: center">
                                    <td>{{ $send_money->transaction_id }}</td>
                                    <td>
                                        @if(isset($send_money->sender_number))
                                            {{ $send_money->sender_number }}
                                        @else
                                            <b>Invalid Sender A/C</b>
                                        @endif
                                    </td>
                                    <td>{{ $send_money->account_number }}</td>
                                    <td>TK. {{ number_format($send_money->amount,2) }}</td>
                                    <td>{{ $send_money->status == 1 ? 'Success' : 'Pending' }}</td>
                                    <td>
                                        @if($send_money->block_status == 1)
                                            <a href="{{ url('/customer/unblock/'.$send_money->id) }}" class="btn btn-outline-primary">Unblock</a>
                                        @else
                                            <a href="{{ url('/customer/block/'.$send_money->id) }}" class="btn btn-outline-danger">Block</a>
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