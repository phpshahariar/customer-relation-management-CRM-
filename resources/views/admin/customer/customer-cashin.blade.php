@extends('admin.master')

@section('content')

    <div class="container">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                CashIn Request</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr style="text-align: center;">
                            <th>SL</th>
                            <th>Method Name</th>
                            <th>Method Description</th>
                            <th>Transaction  ID</th>
                            <th>Amount</th>
                            <th>Images</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customer_cash_in as $key => $info)
                            <tr style="text-align: center;">
                                <td>{{ $key+1 }}</td>
                                <td>{{ $info->customer_cash_in->method_name }}</td>
                                <td>{!! substr($info->payment_method,0,80) !!}</td>
                                <td>{!! $info->user_account !!}</td>
                                <td>TK . {{ number_format($info->amount,2) }}</td>
                                <td>
                                    @if(isset($info->images))
                                        <img src="{{ asset('/bank-images/'.$info->images) }}" height="50" width="80"/>
                                    @else
                                        <b>N/A</b>
                                    @endif
                                </td>
                                <td width="10%">
                                    @if($info->status ==0)
                                        <a href="{{ url('/accept/cashin/request/'.$info->id) }}" class="badge badge-primary">Need Accept</a>
                                    @else
                                        <p class="badge badge-danger">Accepted</p>
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