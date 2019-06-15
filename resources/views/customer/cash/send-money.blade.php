@extends('customer.master')

@section('content')

    <div class="container">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Send Money
        </button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Send Money</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('/customer/send/money') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="number" name="amount" required id="amount" class="form-control" placeholder="Amount">
                            </div>
                            <div class="form-group">
                                <input type="number" name="account_number" required id="account_number" class="form-control" placeholder="account_number">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <br/>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Send Money List</div>
            @if(Session::get('message'))
                <p class="alert alert-success" style="text-align: center;">{{ Session::get('message') }}</p>
            @endif
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr style="text-align: center;">
                            <th>SL NO</th>
                            <th>Send Account</th>
                            <span style="color: red"> {{ $errors->has('account_number') ? $errors->first('account_number') : ' ' }}</span>
                            <th>Send Amount</th>
                            <span style="color: red"> {{ $errors->has('amount') ? $errors->first('amount') : ' ' }}</span>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection