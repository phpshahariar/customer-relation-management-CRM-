@extends('customer.master')

@section('content')

    <div class="container">
        @if(Session::get('message'))
            <h3 class="alert alert-success">{{ Session::get('message') }}</h3>
        @endif
        <div style="margin-left: 20px;">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#CashInRequest">
                CashIn Request
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="CashInRequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ Auth::user()->name }} Cash In Request Form</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('/request/customer/cashin') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Amount : </label>
                                <input type="number" name="amount" required id="amount" class="form-control" placeholder="Amount">
                                <input type="hidden" value="{{ Auth::user()->account_number }}" required name="user_account" class="form-control">
                                <input type="hidden" value="{{ Auth::user()->id }}" required name="user_id" class="form-control">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" name="btn" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <div class="card">
            <!-- Button trigger modal -->
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr style="text-align: center">
                        <th>SL</th>
                        <th>Request Amount</th>
                        <th>Status</th>
                        <th width="8%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customer_cash_in_info as $key => $cashIn)
                        <tr style="text-align: center">
                            <td>{{ $key+1 }}</td>
                            <td>TK . {{ number_format($cashIn->amount,2) }}</td>
                            <span style="color: red"> {{ $errors->has('amount') ? $errors->first('amount') : ' ' }}</span>
                            <td>
                                @if($cashIn->status ==0)
                                    <p class="badge badge-warning">
                                        <span>Pending</span>
                                    </p>
                                @else
                                    <p class="badge badge-success">
                                        <span>Accept</span>
                                    </p>
                                @endif
                            </td>
                            <td width="8%">
                                <a href="{{ url('/delete/customer/cashin/'.$cashIn->id) }}" onclick="return confirm('Are You Sure Delete Cash In Request?')" class="badge badge-danger">
                                    <span class="fa fa-trash"></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection