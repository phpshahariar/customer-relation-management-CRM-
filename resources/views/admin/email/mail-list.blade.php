@extends('admin.master')

@section('content')
    <div class="container">
        @if(Session::get('message'))
            <h4 class="alert alert-success">{{ Session::get('message') }}</h4>
        @endif
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Cash In Table
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr style="text-align: center">
                            <th width="5%">SL NO</th>
                            <th width="10%">Reseller Name</th>
                            <th width="20%">Customer Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i = 0)
                        @foreach($send_mail as $mail_list)
                            <tr style="text-align: center;">
                                <td>{{ $i++ }}</td>
                                <td>{!! $mail_list->reseller_name->name !!}</td>
                                <td>{!! substr($mail_list->email,0,80) !!}...</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection