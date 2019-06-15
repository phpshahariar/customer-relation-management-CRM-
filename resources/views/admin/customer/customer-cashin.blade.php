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
                            <th width="5%">SL NO</th>
                            <th>Customer Name</th>
                            <th>Amount</th>
                            <th width="10%">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customer_cash_in as $key => $info)
                            <tr style="text-align: center;">
                                <td width="5%">{{ $key+1 }}</td>
                                <td>{{ $info->customer_name->name }}</td>
                                <td>Tk. {{ number_format($info->amount,2) }}</td>
                                <td width="10%">
                                    @if($info->status ==0)
                                        <a href="{{ url('/accept/cashin/request/'.$info->id) }}" class="badge badge-primary">Need Accept</a>
                                    @else
                                        <a href="{{ url('/reject/cashin/request/'.$info->id) }}" class="badge badge-danger">Reject</a>
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