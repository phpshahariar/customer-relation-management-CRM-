@extends('customer.master')

@section('content')

    <div class="container">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".access-power">Access Request</button>

        <div class="modal fade access-power" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ url('/need/access/power') }}" method="POST">
                        @csrf
                            <div class="col-md-12">
                                <div class="col-md-12 card-header">
                                    @if(Session::get('message'))
                                        <h5 style="text-align: center;" class="alert alert-success">{!! Session::get('message') !!}</h5>
                                    @endif
                                    <div class="form-group">
                                        <label style="font-size: 24px;">Customer Access Power : </label>
                                        <br/>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name="money_transfer" type="checkbox" id="inlineCheckbox1" value="Money_transfer">
                                            <span style="color: red"> {{ $errors->has('money_transfer') ? $errors->first('money_transfer') : ' ' }}</span>
                                            <label class="form-check-label" for="inlineCheckbox1">Money Transfer</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name="crm" type="checkbox" id="inlineCheckbox2" value="CRM">
                                            <span style="color: red"> {{ $errors->has('crm') ? $errors->first('crm') : ' ' }}</span>
                                            <label class="form-check-label" for="inlineCheckbox2">CRM</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label> Full Name : </label>
                                            <input type="text" required name="full_name" class="form-control" placeholder="Full name">
                                        </div>
                                        <div class="col">
                                            <label> Your Email : </label>
                                            <input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label> Personal Phone Number : </label>
                                            <input type="number" required name="phone" class="form-control" placeholder="Enter Your Number">
                                        </div>
                                        <div class="col">
                                            <label> Emergency Phone Number : </label>
                                            <input type="number" required name="second_phone" class="form-control" placeholder="Enter Your Secondary Phone Number">
                                        </div>
                                    </div>
                                        <div class="row">
                                            <div class="col">
                                                <label> Passport/NIT/DOB : </label>
                                                <input type="text" required name="nationality" class="form-control" placeholder="Enter Your Nationality Number">
                                            </div>
                                            <div class="col">
                                                <label> Account Number : </label>
                                                <input type="number" name="ac_number"  class="form-control" value="{{ Auth::user()->account_number }}" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label> Address : </label>
                                                <textarea required name="address" class="form-control" placeholder="Enter Your Address"></textarea>
                                            </div>
                                            <div class="col">
                                                <label> Select Country: </label>
                                                <select class="form-control" required name="country">
                                                    <option>---</option>
                                                    <option value="bangladesh">Bangladesh</option>
                                                    <option value="australia">Australia</option>
                                                    <option value="usa">USA</option>
                                                    <option value="kuwait">Kuwait</option>
                                                    <option value="uae">UAE</option>
                                                    <option value="canada">Canada</option>
                                                    <option value="soudi_arab">Saudi Arab</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label> TIN Number : </label>
                                                <input type="number"  name="tin_number" class="form-control" placeholder="Enter Your TIN Number (Optional)">
                                            </div>
                                            <div class="col">
                                                <label> Nominee Name: </label>
                                                <input type="text" name="nominee"  class="form-control" placeholder="Enter Your Nominee Name (Optional)">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label style="font-size: 24px;">Transaction Currency : </label>
                                            <br/>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="cd" type="checkbox" id="inlineCheckbox1" value="CD">
                                                <span style="color: red"> {{ $errors->has('money_transfer') ? $errors->first('money_transfer') : ' ' }}</span>
                                                <label class="form-check-label" for="inlineCheckbox1">CD</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="sd" type="checkbox" id="inlineCheckbox2" value="SD">
                                                <span style="color: red"> {{ $errors->has('crm') ? $errors->first('crm') : ' ' }}</span>
                                                <label class="form-check-label" for="inlineCheckbox2">SD</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="usd" type="checkbox" id="inlineCheckbox1" value="USD">
                                                <span style="color: red"> {{ $errors->has('money_transfer') ? $errors->first('money_transfer') : ' ' }}</span>
                                                <label class="form-check-label" for="inlineCheckbox1">USD</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="bdt" type="checkbox" id="inlineCheckbox2" value="BDT">
                                                <span style="color: red"> {{ $errors->has('crm') ? $errors->first('crm') : ' ' }}</span>
                                                <label class="form-check-label" for="inlineCheckbox2">BDT</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="eur" type="checkbox" id="inlineCheckbox2" value="EUR">
                                                <span style="color: red"> {{ $errors->has('crm') ? $errors->first('crm') : ' ' }}</span>
                                                <label class="form-check-label" for="inlineCheckbox2">EUR</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="inr" type="checkbox" id="inlineCheckbox1" value="INR">
                                                <span style="color: red"> {{ $errors->has('money_transfer') ? $errors->first('money_transfer') : ' ' }}</span>
                                                <label class="form-check-label" for="inlineCheckbox1">INR</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="aed" type="checkbox" id="inlineCheckbox2" value="AED">
                                                <span style="color: red"> {{ $errors->has('crm') ? $errors->first('crm') : ' ' }}</span>
                                                <label class="form-check-label" for="inlineCheckbox2">AED</label>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Access Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<br>

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
{{--                        @foreach($all_access as $key => $info)--}}
{{--                            <tr style="text-align: center;">--}}
{{--                                <td width="5%">{{ $key+1 }}</td>--}}
{{--                                <td>{{ $info->customer_name->name }}</td>--}}
{{--                                <td>--}}
{{--                                    {{ $info->money_transfer }}<br>--}}
{{--                                    @if($info->money_status ==1)--}}
{{--                                        <a href="{{ url('/access/permitted/'.$info->id) }}" class="badge badge-success">Permitted</a>--}}
{{--                                    @else--}}
{{--                                        <a href="{{ url('/access/denied/'.$info->id) }}" class="badge badge-warning">Denied</a>--}}
{{--                                    @endif--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    {{ $info->crm }}<br>--}}
{{--                                    @if($info->crm_status ==1)--}}
{{--                                        <a href="{{ url('/crm/access/permitted/'.$info->id) }}" class="badge badge-success">Permitted</a>--}}
{{--                                    @else--}}
{{--                                        <a href="{{ url('/crm/access/denied/'.$info->id) }}" class="badge badge-warning">Denied</a>--}}
{{--                                    @endif--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection