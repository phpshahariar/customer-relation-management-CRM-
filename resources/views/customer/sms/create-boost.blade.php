@extends('customer.master')

@section('content')
    <div class="container">
        <div class="col-md-9 mx-auto">
            <div class="card mb-3">
                <div class="card">
                    <div class="card-header">
                        <h2>Boosting</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/send/customer/sms') }}" method="POST" name="smsForm" onsubmit="return validateForm()">
                            @csrf

                            <div class="form-group">
                                <table class="table table-borderless">
                                    <tr>
                                        <th>Total Contact : {{ count($show_contact) }}</th>
                                        <th>Total Cost : &nbsp;<b class="totalPrice"></b></th>
                                    </tr>
                                </table>
                                Input :<input type="text" name="qty" id="qty" style="border-radius: 5px; margin-left: 100px;"> &nbsp;Quantity
                                <input type="hidden" readonly  name="price" value="{{ $service }}">
                                <span style="color: red"> {{ $errors->has('sms') ? $errors->first('sms') : ' ' }}</span>
                            </div>
                            <div class="form-group">
                                <label>Enter Your Message :</label>
                                <textarea name="message" onkeyup="charsCount(this);"  class="form-control" placeholder="Enter Your Message"></textarea>
                                <span style="color: red"> {{ $errors->has('message') ? $errors->first('message') : ' ' }}</span>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="btn" class="btn btn-success btn-block" value="Send" >
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        $("#qty").on('keyup',function(){
            var qty = $(this).val();
            var total = qty*2;
            console.log(total);
            // var total = qty*1;
             $(".totalPrice").text(total + ' ' + 'Tk');
        })
    </script>

@endsection