@extends('admin.master')

@section('content')

    <div class="container">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Service Fee</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr style="text-align: center;">
                            <th>SL</th>
                            <th>Service</th>
                            <th>SMS Fee</th>
                            <th>Boost Fee</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($fees as $key => $service)
                                <tr style="text-align: center">
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $service->serviceFee }}</td>
                                    <td>TK.{{ number_format($service->price,2) }}</td>
                                    @foreach($boost_fee as $fee)
                                        <td>TK.{{ number_format($fee->price,2) }}</td>
                                    @endforeach
                                    <td>
                                        <a href="{{ url('/edit/sms/service/'.$service->id) }}" class="btn btn-primary">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Service Fee</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr style="text-align: center;">
                            <th>SL</th>
                            <th>Service</th>
                            <th>Email Fee</th>
                            <th>Boost Fee</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($email_fee as $key => $email)
                            <tr style="text-align: center">
                                <td>{{ $key+1 }}</td>
                                <td>{{ $email->servicename }}</td>
                                <td>TK.{{ number_format($email->price,2) }}</td>
                                @foreach($boost_fee as $fee)
                                    <td>TK.{{ number_format($fee->price,2) }}</td>
                                @endforeach
                                <td>
                                    <a href="{{ url('/edit/email/service/'.$email->id) }}" class="btn btn-primary">Edit</a>
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

