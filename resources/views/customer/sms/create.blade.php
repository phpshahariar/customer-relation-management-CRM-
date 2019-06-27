@extends('customer.master')

@section('content')
    <div class="container">
        @if(Session::get('message'))
            <h5 class="alert alert-success">{{Session::get('message')}}</h5>
        @endif

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h2>Single SMS Send</h2>
                            </div>
                            <div class="card-body">
                                <form action="{{ url('/send/customer/sms') }}" method="POST" name="smsForm" onsubmit="return validateForm()">
                                    @csrf
                                    <div class="form-group">
                                        <label>Enter Phone Number : </label>
                                        <input type="text"  name="number" class="form-control" placeholder="Enter Valid Phone Number....">
                                        <span style="color: red"> {{ $errors->has('sms') ? $errors->first('sms') : ' ' }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Enter Your Message : </label>
                                        <textarea name="message"  id="editor2" class="form-control" placeholder="Enter Your Message"></textarea>
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
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h2>Group SMS Send</h2>
                            </div>
                            <div class="card-body">
                                <form action="{{ url('/send-sms-multi') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Select Enter Your Group : </label>
                                        <select class="form-control phoneNumber"  name="group_id" id="group_id">
                                            <option> -- Select Group -- </option>
                                            @foreach($all_group as $group)
                                                <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="card-body" style="display: none;">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                <tr style="text-align: center;">
                                                    <th width="10%">SL NO</th>
                                                    <th>Group Name</th>
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                </tr>
                                                </thead>
                                                <tbody id="show_by_customer_sms">
                                                @foreach($users as $user)
                                                    <tr style="text-align: center;">
                                                        <td>{{ $user->id }}</td>
                                                        <td>{{ $user->customer_group->group_name }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->phone }}</td>
                                                        <td style="display: none;"><input type="number" name="number[]" value="{{ $user->phone }}"></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Enter Your Message : </label>
                                        <textarea name="group_message"  id="editor1" class="form-control" placeholder="Enter Your Message"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" name="btn" class="btn btn-primary btn-block" value="Send" >
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('/assets/') }}/vendor/jquery/jquery.min.js"></script>
    <script src="//cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'editor1' );
    </script>

    <script>
        CKEDITOR.replace( 'editor2' );
    </script>

    <script>
        function validateForm() {
            var x = document.forms["smsForm"]["number"].value;
            var y = document.forms["smsForm"]["message"].value;
            if (x == "") {
                alert("Number Must be Filled out");
                return false;
            }else if (y == "") {
                alert("Message Must be Filled out");
                return false;
            }
        }
    </script>

    <script>
        $(document).ready(function () {
            $('#group_id').on('change', function () {
                var id = $(this).val();
                $.ajax({
                    url: "{{url('/customer-sms')}}/" + id,
                    type: "GET",
                    data: {id: id},
                    success:function (data) {
                        console.log(data);
                        $('#show_by_customer_sms').html(data);
                    }
                });
            });
        })
    </script>
@endsection