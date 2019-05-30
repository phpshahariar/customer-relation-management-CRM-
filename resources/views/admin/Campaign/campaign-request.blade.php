@extends('admin.master')

@section('content')

    <div class="container">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Campaign Request</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>ReSeller Name</th>
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
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $info->reseller->name }}</td>
                                <td>{{ $info->start_date }}</td>
                                <td>{{ $info->end_date }}</td>
                                <td>{{ $info->link }}</td>
                                <td>{{ substr($info->filtering,0,100) }}....</td>
                                <td>Tk. {{ number_format($info->amount,2) }}</td>
                                <td>
                                    @if($info->status ==0)
                                        <a href="{{ url('/accept/request/'.$info->id) }}" class="badge badge-primary">Need Accept</a>
                                    @else
                                        <a href="{{ url('/reject/request/'.$info->id) }}" class="badge badge-danger">Reject</a>
                                    @endif
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