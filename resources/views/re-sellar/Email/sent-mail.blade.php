@extends('re-sellar.master')


@section('content')
    <div class="container">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                All Send Mail</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>E-mail</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($send_mail as $key => $send)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{!! substr($send->email,0,50) !!}......</td>
                                <td>{!! substr($send->message,0,50) !!}.....</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-info" value="">Edit</a>
                                    <a href="#" class="btn btn-sm btn-danger" value="">Delete</a>
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