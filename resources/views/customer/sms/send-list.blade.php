@extends('customer.master')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fas fa-table"></i>
                            All Send SMS</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr style="text-align: center;">
                                        <th width="10%">SL NO</th>
                                        <th width="20%">Phone Number</th>
                                        <th width="20%">Message</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($customer_sms_list as $key => $send)
                                        <tr>
                                            <td>{{ date_format($send->created_at, "Y/m/d") }}</td>
                                            <td>{!! substr($send->number,0,80) !!}......</td>
                                            <td>{!! substr($send->message,0,50) !!}.....</td>
{{--                                            <td style="text-align: center;">--}}
{{--                                                <a href="{{ url('/send/sms/delete/'.$send->id) }}" onclick="return confirm('Are you Sure Delete This?')" class="badge badge-danger" value="">Delete</a>--}}
{{--                                            </td>--}}
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header">
                            <form class="form-inline" style="margin-left: 20px;">
                                <div class="form-group mx-sm-3 mb-2">
                                    <input type="text" name="search" class="form-control" id="inputPassword2" placeholder="Searching....">
                                </div>
                                <button type="submit" class="btn btn-primary mb-2">Search</button>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr style="text-align: center;">
                                        <th width="10%">SL NO</th>
                                        <th width="20%">Group Name</th>
                                        <th width="20%">Message</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sms_group_list as $key => $send_list)
                                        <tr>
                                            <td>{{ date_format($send_list->created_at, "Y/m/d") }}</td>
                                            <td>{!! $send_list->group->group_name !!}</td>
                                            <td>{!! substr($send_list->group_message,0,50) !!}.....</td>
                                            {{--                                            <td style="text-align: center;">--}}
                                            {{--                                                <a href="{{ url('/send/sms/delete/'.$send->id) }}" onclick="return confirm('Are you Sure Delete This?')" class="badge badge-danger" value="">Delete</a>--}}
                                            {{--                                            </td>--}}
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--    Customer Send Mail View--}}


    <div class="modal fade" id="viewCampaign" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="CustomerName">Customer Campaign Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="name"></div>
                    <br/>
                    <div class="phone_number"></div>
                    <div class="message_send"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <script>
        $(document).ready(function () {
            $(document).on("click", "#view", function (e) {
                e.preventDefault();
                var id = $(this).data("id");
                var url = $(this).attr("href");
                console.log( id + url );

                $.ajax({
                    url:url,
                    type:"GET",
                    data:{id:id},
                    dataType:"JSON",
                    success:function (response) {
                    console.log(response);
                        if ($.isEmptyObject(response) != null){
                            $("#viewCampaign").modal("show");
                            // $("#CustomerName").text(response.customer_name + "Data");
                            $(".name").text("Name : " + response.name);
                            $(".phone").text("Number : " + response.number);
                            $(".message").text("Send Message : " + response.message);
                        }
                    }
                })
            })
        })
    </script>

@endsection