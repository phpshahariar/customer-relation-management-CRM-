@extends('customer.master')

@section('content')
    <div class="container">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                All Group SMS</div>
            <br/>
            <form action="{{ url('/group/sms/send') }}" method="POST" name="groupSelect" onsubmit="return validateForm()">
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
                                <tr style="text-align: center;">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <input type="submit" name="btn" class="btn btn-danger btn-block" value="Send Group SMS">
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
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
        function validateForm() {
            var x = document.forms["groupSelect"]["group_id"].value;
            if (x == "") {
                alert("Group Must be Filled out");
                return false;
            }
        }
    </script>
@endsection