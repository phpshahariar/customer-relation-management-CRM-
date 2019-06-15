@extends('admin.master')

@section('content')
    <div class="container">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Email List
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr style="text-align: center">
                            <th width="5%">SL NO</th>
                            <th width="8%">Customer Name</th>
                            <th width="20%">Send Email</th>
                            <th width="20%">Message</th>
                            <th width="8%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i = 0)
                        @foreach($all_customer_mail as $mail_list)
                            <tr style="text-align: center;">
                                <td>{{ $i++ }}</td>
                                <td>{!! $mail_list->customer_name->name !!}</td>
                                <td>{!! substr($mail_list->email,0,50) !!}</td>
                                <td>{!! substr($mail_list->message,0,50) !!}</td>
                                <td>
                                    <a href="{!! url('view/mail/send') !!}" data-id="{{ $mail_list->id }}" id="view" class="badge badge-danger">View</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

{{--    Modal View By mail--}}

    <div class="modal fade" id="viewCustomerMail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="CustomerName">Customer Email Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="name"></div>
                    <br/>
                    <div class="user_account"></div>
                    <div class="send_email"></div>
                    <div class="send_message"></div>
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
                        if ($.isEmptyObject(response) !=null){
                            $("#viewCustomerMail").modal("show");
                            $(".name").text("User_id : " + response.user_id);
                            $(".user_account").text("User Account Number : " + response.user_account);
                            $(".send_email").text("Send Email : " + response.email);
                            $(".send_message").text("Send Message : " + response.message);
                        }
                    }
                });
            })

        })
    </script>

@endsection