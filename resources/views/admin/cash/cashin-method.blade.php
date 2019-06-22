@extends('admin.master')

@section('content')
    <div class="container">
        <a href="{{ url('/add/method') }}" class="btn btn-success">Add Method</a>
        <br>
        <br>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Cashin Method</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr style="text-align: center;">
                            <th width="10%">SL NO</th>
                            <th>Payment Method</th>
                            <th>Method Description</th>
                            <th width="15%">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($show_method as $key => $method)
                            <tr>
                                <td>{{ $key }}</td>
                                <td>{!! $method->method_name !!}</td>
                                <td>{!! substr($method->method_description,0,150) !!}[...]</td>
                                <td width="15%">
                                    @if($method->status == 1)
                                    <a href="{{ url('/active/method/'.$method->id) }}" class="badge badge-success">Active</a>
                                    @else
                                    <a href="{{ url('/pending/method/'.$method->id) }}" class="badge badge-warning">Pending</a>
                                    @endif
                                    <a href="{{ url('/edit/method/'.$method->id) }}" class="badge badge-info">Edit</a>
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