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
                                <input type="number" name="amount" required id="amount" class="form-control input" value="">
                                <input type="number" name="main_amount"  id="main_amount" class="form-control input" value="{{$totalCashOut}}">
                            </div>

                            <div class="form-group">
                                <input type="number" name="account_number" required id="account_number" class="form-control" placeholder="account_number">
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="user_id" class="form-control user_id" placeholder="user_id">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                @if($totalCashOut > 0)
                                    <button type="submit" class="btn btn-primary">Send</button>
                                @else
                                    <button type="button" id="btnDisable" class="btn btn-primary disabled">Insufficient Balance</button>
                                @endif
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
                            <th>Name</th>
                            <th>Send Account</th>
                            <span style="color: red"> {{ $errors->has('account_number') ? $errors->first('account_number') : ' ' }}</span>
                            <th>Send Amount</th>
                            <span style="color: red"> {{ $errors->has('amount') ? $errors->first('amount') : ' ' }}</span>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i = 0)
                            @foreach($customer_money_send as $money_send)
                              <tr style="text-align: center">
                                <td>{{ $i++ }}</td>
                                <td>{{ $money_send->customer_account->name }}</td>
                                <td>{{ $money_send->account_number }}</td>
                                <td>TK. {{ number_format($money_send->amount,2) }}</td>
                                  <td>
                                      @if($money_send->status == 1)
                                        <p class="badge badge-success">Success</p>
                                      @else
                                        <p class="badge badge-danger">Pending</p>
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

    <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    <script>
        $(document).on('keyup','#account_number', function () {
            var account_number = $(this).val();
            $.ajax({
                type:'GET',
                url: "{{ url('/customer/user/id') }}",
                data:{account_number:account_number},
                success:function (data) {
                    for (var i=0; i<data.length; i++) {
                        $('.user_id').val(data[i].id);
                    }
                }
            });
        });
    </script>

    <script>
        $('.input').on('input', function () {
            var value = $(this).val();
            var data = $('#main_amount').val();
            if ((value !== '') && (value.indexOf('.') === -1)) {
                $(this).val(Math.max(Math.min(value, data), -data));
                if (data < value) {
                    // alert('you have reached a limit');
                    Swal.fire({
                        type: 'error',
                        title: 'SORRY',
                        text: 'SORRY Insufficient Balance!',
                    })
                }
            }
        });

        // $( "#myinput2" ).on('input', function() {
        //     if ($(this).val().length>=3) {
        //         alert('you have reached a limit of 3');
        //     }
        // });
    </script>




@endsection