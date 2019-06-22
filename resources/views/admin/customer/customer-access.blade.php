@extends('admin.master')

@section('content')

    <div class="container">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Access Power</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr style="text-align: center;">
                            <th width="5%">SL NO</th>
                            <th>Customer Name</th>
                            <th>Money Transfer</th>
                            <th>CRM Access</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($all_access as $key => $info)
                            <tr style="text-align: center;">
                                <td width="5%">{{ $key+1 }}</td>
                                <td>{{ $info->customer_name->name }}</td>
                                <td>
                                    @if(isset($info->money_transfer))
                                        {{ $info->money_transfer }}<br>
                                    @if($info->money_status ==1)
                                        <a href="{{ url('/access/permitted/'.$info->id) }}" class="badge badge-success">Permitted</a>
                                    @else
                                        <a href="{{ url('/access/denied/'.$info->id) }}" class="badge badge-warning">Denied</a>
                                    @endif
                                    @else
                                        <b>N/A</b>
                                    @endif
                                </td>
                                <td>
                                    @if(isset($info->crm))
                                    {{ $info->crm }}<br>
                                    @if($info->crm_status ==1)
                                        <a href="{{ url('/crm/access/permitted/'.$info->id) }}" class="badge badge-success">Permitted</a>
                                    @else
                                        <a href="{{ url('/crm/access/denied/'.$info->id) }}" class="badge badge-warning">Denied</a>
                                    @endif
                                    @else
                                        <b>N/A</b>
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