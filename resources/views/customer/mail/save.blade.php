@extends('customer.master')


@section('content')
    <div class="container">
        @if(Session::get('message'))
            <h5 class="alert alert-success">{{Session::get('message')}}</h5>
        @endif
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                All Save Mail</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr style="text-align: center;">
                            <th>SL NO</th>
                            <th>E-mail</th>
                            <th>Message</th>
                            <th width="15%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($send_mail as $key => $send)
                            <tr style="text-align: center;">
                                <td>{{ $key+1 }}</td>
                                <td>{!! substr($send->email,0,80) !!}</td>
                                <td>{!! substr($send->message,0,80) !!}</td>
                                <td width="15%">
                                    <a href="{{ url('/delete/email/'.$send->id) }}" onclick="return confirm('Are You Sure Delete This!?');" class="badge badge-danger" value="">Delete</a>
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