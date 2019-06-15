@extends('customer.master')

@section('content')
    <div class="container">
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
                            <th>Phone Number</th>
                            <th>Message</th>
                            <th width="15%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customer_sms_list as $key => $send)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{!! substr($send->number,0,80) !!}......</td>
                                <td>{!! substr($send->message,0,50) !!}.....</td>
                                <td style="text-align: center;">
                                    <a href="{{ url('/send/sms/view/'.$send->id) }}" class="badge badge-success">View</a>
                                    <a href="{{ url('/send/sms/delete/'.$send->id) }}" onclick="return confirm('Are you Sure Delete This?')" class="badge badge-danger" value="">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection