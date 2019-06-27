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
                        <form action="{{ url('/request/customer/cashin') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <select class="form-control" name="method_name" id="method_name_id">
                                <option>Select Method Name</option>
                                @foreach($payment_method as $payment)
                                    <option value="{{ $payment->id }}">{{ $payment->method_name }}</option>
                                @endforeach
                            </select>
                            <style>
                                .methodDescription {
                                    margin-top: 10px;
                                    border: 1px solid green;
                                    padding: 5px;
                                }
                            </style>
                            <div class="methodDescriptionHide" >
                                <textarea class="form-control methodDescription" rows="5" name="payment_method" readonly></textarea>
                            </div>
                            <div class="form-group">
                                <label>Transaction  ID </label>
                                <input type="number"  name="user_account" class="form-control" placeholder="Enter Your Transaction ID...">
                            </div>
                            <div class="form-group">
                                <label>Amount : </label>
                                <input type="number" name="amount" required id="amount" class="form-control" placeholder="Amount">
                                <input type="hidden" value="{{ Auth::user()->id }}"  name="user_id" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="file" name="images">
                            </div>
                            <div class="form-group">
                                <label>Note : </label>
                                <textarea class="form-control" rows="5" name="note"></textarea>
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
                        <th>Date</th>
                        <th>Method Name</th>
                        <th>Notes</th>
                        <th>Transaction  ID</th>
                        <th>Amount</th>
                        <th>Images</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customer_cash_in_info as $key => $cashIn)
                        <tr style="text-align: center">
                            <td>{{ $cashIn->created_at }}</td>
                            <td>{{ $cashIn->customer_cash_in->method_name }}</td>
                            <td>
                                @if(isset($cashIn->note))
                                    {!! substr($cashIn->note,0,80) !!}
                                @else
                                    <b>N/A</b>
                                @endif
                            </td>
                            <td>{!! $cashIn->user_account !!}</td>
                            <td>TK . {{ number_format($cashIn->amount,2) }}</td>
                            <td>
                                @if(isset($cashIn->images))
                                    <img src="{{ asset('/bank-images/'.$cashIn->images) }}" height="50" width="80"/>
                                @else
                                    <b>N/A</b>
                                @endif
                            </td>
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
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    
    <script>
        $('.methodDescriptionHide').hide();
        $('#method_name_id').change(function () {
            let id = $(this).val();
            $.ajax({
                type:'GET',
                url: "{{ url('/select/payment/method') }}",
                data:{id:id},
                success:function (data) {
                    $('.methodDescriptionHide').show();
                    for (var i=0; i<data.length; i++) {
                        $('.methodDescription').html(data[i].method_description);
                    }
                },
                error:function () {
                    console.log('I am not sure');
                }
            });

        })
    </script>

@endsection