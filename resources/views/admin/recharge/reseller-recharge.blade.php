@extends('admin.master')

@section('content')
    <div class="container">
        @if(Session::get('message'))
            <h4 class="alert alert-success">{{ Session::get('message') }}</h4>
        @endif
        <div class="card-body">
            <!-- Button trigger modal -->
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#recharge">
                            Recharge
                        </button>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-2 bg-success" style="border-radius: 8px;">
                        <div style="margin-top: 5px; color: white;">Total : <span class="badge badge-warning" style="text-align: right;">TK. {{ number_format($totalrecharge,2) }}</span></div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="recharge" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> Cash In</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('/cash/recharge') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" name="amount" required class="form-control" placeholder="Enter Your Amount">
                                    <span style="color: red"> {{ $errors->has('amount') ? $errors->first('amount') : ' ' }}</span>
                                </div>
                                <div class="form-group">
                                    <label>Reseller Account Number</label>
                                    <select class="form-control" name="reseller_account_id">
                                        <option> --- Select Reseller A/C --- </option>
                                        @foreach($all_reseller as $reseller)
                                            <option value="{{ $reseller->id }}">{{ $reseller->account_number }}</option>
                                        @endforeach
                                    </select>
                                    <span style="color: red"> {{ $errors->has('reseller_account_id') ? $errors->first('reseller_account_id') : ' ' }}</span>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="btn" class="btn btn-primary">SubmiT</button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Cash In Table
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr style="text-align: center">
                            <th width="5%">SL NO</th>
                            <th width="25%">Name</th>
                            <th width="20%">Date</th>
                            <th>Account Number</th>
                            <th>Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($all_recharge as $key => $show)
                            <tr style="text-align: center;">
                                <td>{{ $key+1 }}</td>
                                <td>{{ $show->reseller->name }}</td>
                                <td>{{ date("d-M-Y", strtotime($show->created_at)) }}</td>
                                <td>{{ $show->reseller->account_number }}</td>
                                <td>TK. {{ number_format($show->amount,2) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection