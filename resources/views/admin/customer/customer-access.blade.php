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
                            <th>Email</th>
                            <th>Phone</th>
                            <span style="color: red"> {{ $errors->has('phone') ? $errors->first('phone') : ' ' }}</span>
                            <th>Secondary Phone</th>
                            <span style="color: red"> {{ $errors->has('second_phone') ? $errors->first('second_phone') : ' ' }}</span>
                            <th>Nationality No</th>
                            <span style="color: red"> {{ $errors->has('nationality') ? $errors->first('nationality') : ' ' }}</span>
                            <th>address</th>
                            <span style="color: red"> {{ $errors->has('address') ? $errors->first('address') : ' ' }}</span>
                            <th>country</th>
                            <span style="color: red"> {{ $errors->has('country') ? $errors->first('country') : ' ' }}</span>
                            <th>TIN</th>
                            <th>Nominee</th>
                            <th>Currency CD</th>
                            <th>Currency SD</th>
                            <th>Currency USD</th>
                            <th>Currency BDT</th>
                            <th>Currency AED</th>
                            <th>Currency INR</th>
                            <th>Currency EUR</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($all_access as $key => $info)
                            <tr style="text-align: center;">
                                <td width="5%">{{ $key+1 }}</td>
                                <td>{{ $info->full_name }}</td>
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
                                <td>
                                    @if(isset($info->email))
                                        {{ $info->email }}
                                    @else
                                        <b style="color: red;">NA</b>
                                    @endif
                                </td>
                                <td>
                                    @if(isset($info->phone))
                                        {{ $info->phone }}
                                    @else
                                        <b style="color: red;">NA</b>
                                    @endif
                                </td>
                                <td>
                                    @if(isset($info->second_phone))
                                        {{ $info->second_phone }}
                                    @else
                                        <b style="color: red;">NA</b>
                                    @endif
                                </td>
                                <td>
                                    @if(isset($info->nationality))
                                        {{ $info->nationality }}
                                    @else
                                        <b style="color: red;">NA</b>
                                    @endif
                                </td>
                                <td>
                                    @if(isset($info->address))
                                        {{ substr($info->address,0,60)}}
                                    @else
                                        <b style="color: red;">NA</b>
                                    @endif
                                </td>
                                <td>
                                    @if(isset($info->country))
                                        {{ $info->country }}
                                    @else
                                        <b style="color: red;">NA</b>
                                    @endif
                                </td>
                                <td>
                                    @if(isset($info->tin_number))
                                        {{ $info->tin_number }}
                                    @else
                                        <b style="color: red;">NA</b>
                                    @endif
                                </td>
                                <td>
                                    @if(isset($info->nominee))
                                        {{ $info->nominee }}
                                    @else
                                        <b style="color: red;">NA</b>
                                    @endif
                                </td>
                                <td>
                                    @if(isset($info->cd))
                                        {{ $info->cd }}
                                    @else
                                        <b style="color: red;">NA</b>
                                    @endif
                                </td>
                                <td>
                                    @if(isset($info->sd))
                                        {{ $info->sd }}
                                    @else
                                        <b style="color: red;">NA</b>
                                    @endif
                                </td>
                                <td>
                                    @if(isset($info->usd))
                                        {{ $info->usd }}
                                    @else
                                        <b style="color: red;">NA</b>
                                    @endif
                                </td>
                                <td>
                                    @if(isset($info->bdt))
                                        {{ $info->bdt }}
                                    @else
                                        <b style="color: red;">NA</b>
                                    @endif
                                </td>
                                <td>
                                    @if(isset($info->eur))
                                        {{ $info->eur }}
                                    @else
                                        <b style="color: red;">NA</b>
                                    @endif
                                </td>
                                <td>
                                    @if(isset($info->inr))
                                        {{ $info->inr }}
                                    @else
                                        <b style="color: red;">NA</b>
                                    @endif
                                </td>
                                <td>
                                    @if(isset($info->aed))
                                        {{ $info->aed }}
                                    @else
                                        <b style="color: red;">NA</b>
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