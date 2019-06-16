@extends('customer.master')

@section('content')
    <div class="container">
        @if(Session::get('message'))
            <h5 class="alert alert-success">{{Session::get('message')}}</h5>
        @endif
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                All Group SMS</div>
            <br/>
            <form action="{{ url('/send-sms-multi') }}" method="POST" name="groupSelect" onsubmit="return validateForm()">
                @csrf
                <div class="col-md-5">
                    <label style="font-size: 24px;">Select Group</label>
                    <select class="form-control phoneNumber"  name="group_id" id="group_id">
                        <option></option>
                        @foreach($all_group as $group)
                            <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="card-body">
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
                <button type="submit" name="btn" class="btn btn-success">Send SMS.....</button>
            </form>
        </div>
    </div>
{{--    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>--}}
    <script src="{{ asset('/assets/') }}/vendor/jquery/jquery.min.js"></script>
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
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('.phoneNumber').on('change', function () {--}}
{{--                var group_id = $(this).val();--}}
{{--                $.ajax({--}}
{{--                    url: "{{url('/phoneNumber/sms')}}",--}}
{{--                    type: "GET",--}}
{{--                    data: {group_id: group_id},--}}
{{--                    success:function (data) {--}}
{{--                        console.log(data);--}}
{{--                        // $('#show_by_customer_sms').html(data);--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--        })--}}
{{--    </script>--}}

    <script>
        // function validateForm() {
        //     var x = document.forms["groupSelect"]["group_id"].value;
        //     if (x == "") {
        //         alert("Group Must be Filled out");
        //         return false;
        //     }
        // }
    </script>
@endsection