@extends('admin.master')
@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            All Cash Out Request</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr style="text-align: center;">
                        <th width="10%">SL NO</th>
                        <th width="15%">Customer</th>
                        <th>Bank Name</th>
                        <th>Bank Account</th>
                        <th>Bank Amount</th>
                        <th>Mobile Bank</th>
                        <th>Mobile Account</th>
                        <th>Mobile Amount</th>
                        <th>Agent ID</th>
                        <th>Agent Amount</th>
                        <th>Others Option</th>
                        <th>Others Amount</th>
                        <th width="15%">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($show_customer_cash_out as $key => $customer_cash_out)
                        <tr style="text-align: center;">
                            <td>{{ $key+1 }}</td>
                            <td>{{ $customer_cash_out->customer_name->name }}</td>
                            <td>
                                @if(isset($customer_cash_out->bank_name))
                                    {{ $customer_cash_out->bank_name }}
                                @else
                                    <b>N/A</b>
                                @endif
                            </td>
                            <td>
                                @if(isset($customer_cash_out->bank_account_number))
                                    {{ $customer_cash_out->bank_account_number }}
                                @else
                                    <b>N/A</b>
                                @endif
                            </td>
                            <td>
                                @if(isset($customer_cash_out->bank_amount))
                                    TK. {{ number_format($customer_cash_out->bank_amount,2) }}
                                @else
                                    <b>N/A</b>
                                @endif
                            </td>
                            <td>
                                @if(isset($customer_cash_out->mobile_bank_name))
                                    {{ $customer_cash_out->mobile_bank_name }}
                                @else
                                    <b>N/A</b>
                                @endif
                            </td>
                            <td>
                                @if(isset($customer_cash_out->mobile_account_number))
                                    {{ $customer_cash_out->mobile_account_number }}
                                @else
                                    <b>N/A</b>
                                @endif
                            </td>
                            <td>TK. {{ number_format($customer_cash_out->mobile_amount,2) }}</td>
                            <td>
                                @if(isset($customer_cash_out->agent_account_number))
                                    {{ $customer_cash_out->agent_account_number }}
                                @else
                                    <b>N/A</b>
                                @endif
                            </td>
                            <td>TK. {{ number_format($customer_cash_out->agent_amount,2) }}</td>
                            <td>
                                @if(isset($customer_cash_out->others))
                                    {{ $customer_cash_out->others }}
                                @else
                                    <b>N/A</b>
                                @endif
                            </td>
                            <td>TK. {{ number_format($customer_cash_out->others_amount,2) }}</td>
                            <td>
                                @if($customer_cash_out->status == 0 )
                                    <a href="{{ url('/cashout/processing/'.$customer_cash_out->id) }}" class="badge badge-danger">Waiting...</a>
                                @elseif ($customer_cash_out->status == 1 )
                                    <a href="{{ url('/cashout/success/'.$customer_cash_out->id) }}" class="badge badge-warning">Processing...</a>
                                @else
                                    <p class="badge badge-success">Success</p>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection
