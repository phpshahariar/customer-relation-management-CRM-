@extends('customer.master')

@section('content')
    <div class="container">
        @if(Session::get('message'))
            <h6 class="alert alert-success text-center">{{Session::get('message')}}</h6>
        @endif
        <button type="button" class="btn btn-success" data-toggle="modal" data-target=".cash-out">Cash Out</button>
        <br/>
        <br/>
        <div class="modal fade cash-out" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ Auth::user()->name }} Cash Out Request Form</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/cash/out') }}" method="POST" id="cashOut" name="selectOption" onsubmit="return validateForm()">
                            @csrf
{{--                            <input type="hidden" name="user_id" class="form-control" value="{{ Auth::user()->id }}">--}}
                            <div class="form-group">
                                <label style="font-size: 18px; font-weight: bold;">Select Cash Out Option : </label>
                                <select class="form-control" name="cash_out_option" id="cash_out_option">
                                    <option></option>
                                    <option value="1">Bank</option>
                                    <option value="2">Mobile Bank</option>
                                    <option value="3">Agent</option>
                                    <option value="4">Others</option>
                                </select>
                            </div>
                            <hr/>
                            <div class="form-group" id="bankShow">
                                <label>Bank Name : </label>
                                <input type="text" name="bank_name" class="form-control" placeholder="Enter Your Bank Name...">
                                <br/>
                                <label>Bank Account Number : </label>
                                <input type="number" name="bank_account_number" class="form-control" placeholder="Enter Your Bank Account Number...">
                                <br/>
                                <label>Bank Amount : </label>
                                <input type="number" name="bank_amount" class="form-control" placeholder="Enter Your Amount...">
                            </div>
                            <div class="form-group" id="mobileBank">
                                <label>Mobile Banking Option: </label>
                                <select class="form-control" name="mobile_bank_name">
                                    <option></option>
                                    <option value="bkash">Bkash</option>
                                    <option value="rocket">Rocket</option>
                                    <option value="nogod">Nogod</option>
                                </select>
                                <br/>
                                <label>Mobile Account Number : </label>
                                <input type="number" name="mobile_account_number" class="form-control" placeholder="Enter Your Mobile Account Number...">
                                <br/>
                                <label>Amount : </label>
                                <input type="number" name="mobile_amount" class="form-control" placeholder="Enter Your Amount...">
                            </div>
                            <div class="form-group" id="agentShow">
                                <label>Agent ID : </label>
                                <input type="number" name="agent_account_number" class="form-control" placeholder="Enter Your User ID...">
                                <br/>
                                <label>Amount : </label>
                                <input type="number" name="agent_amount" class="form-control" placeholder="Enter Your Amount...">
                            </div>
                            <div class="form-group" id="otherShow">
                                <label>Others Option For Cash Out : </label>
                                <textarea class="form-control" rows="5" name="others" placeholder="Enter Your Others Cash Out Options........"></textarea>
                                <br/>
                                <label>Amount : </label>
                                <input type="number" name="others_amount" class="form-control" placeholder="Enter Your Amount...">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                @if($totalCashOut > 0)
                                    <button type="submit" class="btn btn-primary">Send</button>
                                @else
                                    <button type="button" class="btn btn-primary disabled">Insufficient Balance</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Show Cash Out Form -->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                All Cash Out</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr style="text-align: center;">
                            <th width="10%">SL NO</th>
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
                                    @if($customer_cash_out->status == 1 )
                                        <p class="badge badge-warning">Processing...</p>
                                     @elseif ($customer_cash_out->status == 2 )
                                        <p class="badge badge-success">Success</p>
                                     @else
                                        <p class="badge badge-danger">Waiting</p>
                                     @endif
                                </td>
                            </tr>
                         @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End Cash Out Form -->
    </div>

{{--    JQuery Functions--}}

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    
    <script>
        $(document).ready(function () {
            $("#bankShow").hide();
            $("#mobileBank").hide();
            $("#agentShow").hide();
            $("#otherShow").hide();

            $('#cash_out_option').change(function (e) {
                e.preventDefault();
                var data = $(this).val();
                if (data == 1){
                    $('#bankShow').show();
                    $('#otherShow').hide();
                    $('#agentShow').hide();
                    $('#mobileBank').hide();
                }else if (data == 2){
                    $('#mobileBank').show();
                    $('#bankShow').hide();
                    $('#otherShow').hide();
                    $('#agentShow').hide();
                }else if (data == 3){
                    $('#agentShow').show();
                    $('#mobileBank').hide();
                    $('#bankShow').hide();
                    $('#otherShow').hide();
                }else if (data == 4) {
                    $('#otherShow').show();
                    $('#agentShow').hide();
                    $('#mobileBank').hide();
                    $('#bankShow').hide();
                }else {
                    $("#bankShow").hide();
                    $("#mobileBank").hide();
                    $("#agentShow").hide();
                    $("#otherShow").hide();
                }
            });

        });

    </script>

    <script>
        function validateForm() {
            var x = document.forms["selectOption"]["cash_out_option"].value;
            if (x == "") {
                alert("You First Select Cash Out Option");
                return false;
            }
        }
    </script>

@endsection