@extends('admin.master')

@section('content')

    <div class="container">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Customer Campaign Request</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr style="text-align: center;">
                            <th>SL NO</th>
                            <th>Customer Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Link</th>
                            <th>Filtering</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($campaign_request as $key => $info)
                            <tr style="text-align: center;">
                                <td>{{ $key+1 }}</td>
                                <td>{{ $info->customer_name->name }}</td>
                                <td>{{ $info->start_date }}</td>
                                <td>{{ $info->end_date }}</td>
                                <td>{{ $info->link }}</td>
                                <td>{{ substr($info->filtering,0,30) }}....</td>
                                <td>Tk. {{ number_format($info->amount,2) }}</td>
                                <td>
                                    @if($info->status ==0)
                                        <a href="{{ url('/accept/customer/request/'.$info->id) }}" class="badge badge-success">Accept</a>
                                    @else
                                        <p class="badge badge-warning">Accepted</p>
                                    @endif
                                        <a href="{!! url('view/campaign/data') !!}" data-id="{!! $info->id !!}" id="view" class="badge badge-info">View</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

{{--    Modal View--}}

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
                    <div class="sstart_date"></div>
                    <div class="eend_date"></div>
                    <div class="page_link"></div>
                    <div class="filtering_data"></div>
                    <div class="price"></div>
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

                        if ($.isEmptyObject(response) != null){
                            $("#viewCampaign").modal("show");
                            // $("#CustomerName").text(response.customer_name + "Data");
                            $(".name").text("User_id : " + response.user_id);
                            $(".sstart_date").text("Start_Date : " + response.start_date);
                            $(".eend_date").text("End_Date : " + response.end_date);
                            $(".page_link").text("Page Link : " + response.link);
                            $(".filtering_data").text("Filtering Tag  : " + response.filtering);
                            $(".price").text("Boosting Price : " + response.amount + "TK");
                        }
                    }
                })
            })
        })
    </script>

@endsection