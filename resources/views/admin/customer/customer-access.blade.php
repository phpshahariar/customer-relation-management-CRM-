@extends('admin.master')

@section('content')

    <div class="container">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Access Power</div>
            <div class="card-body">
                <form action="{{ url('/access/power') }}" method="POST">
                    @csrf
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6 card-header">
                                @if(Session::get('message'))
                                    <h5 style="text-align: center;" class="alert alert-success">{!! Session::get('message') !!}</h5>
                                @endif
                                <div class="form-group">
                                    <select name="user_id" class="form-control" required>
                                        <option> -- Select Customer -- </option>
                                        @foreach($all_customers as $customers)
                                            <option value="{{ $customers->id }}">{{ $customers->name }}</option>
                                        @endforeach
                                        <span style="color: red"> {{ $errors->has('user_id') ? $errors->first('user_id') : ' ' }}</span>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label style="font-size: 24px;">Customer Access Power : </label>
                                    <br/>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" required name="money_transfer" type="checkbox" id="inlineCheckbox1" value="Money_transfer">
                                        <span style="color: red"> {{ $errors->has('money_transfer') ? $errors->first('money_transfer') : ' ' }}</span>
                                        <label class="form-check-label" for="inlineCheckbox1">Money Transfer</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="crm" type="checkbox" id="inlineCheckbox2" value="CRM">
                                        <span style="color: red"> {{ $errors->has('crm') ? $errors->first('crm') : ' ' }}</span>
                                        <label class="form-check-label" for="inlineCheckbox2">CRM</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-block btn-success" name="btn" value="Access">
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


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
                            <th>Access Power</th>
                            <th>Access Power</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($all_access as $key => $info)
                            <tr style="text-align: center;">
                                <td width="5%">{{ $key+1 }}</td>
                                <td>{{ $info->customer_name->name }}</td>
                                <td>
                                    {{ $info->money_transfer }}<br>
                                    @if($info->money_status ==1)
                                        <a href="{{ url('/access/permitted/'.$info->id) }}" class="badge badge-success">Permitted</a>
                                    @else
                                        <a href="{{ url('/access/denied/'.$info->id) }}" class="badge badge-warning">Denied</a>
                                    @endif
                                </td>
                                <td>
                                    {{ $info->crm }}<br>
                                    @if($info->crm_status ==1)
                                        <a href="{{ url('/crm/access/permitted/'.$info->id) }}" class="badge badge-success">Permitted</a>
                                    @else
                                        <a href="{{ url('/crm/access/denied/'.$info->id) }}" class="badge badge-warning">Denied</a>
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