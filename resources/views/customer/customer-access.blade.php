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
                                            <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
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
                                                <p>Example : Passport no XXXXXXXXX</p>
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
            @if(Session::get('message'))
                <h5 style="text-align: center;" class="alert alert-success">{!! Session::get('message') !!}</h5>
            @endif
            <div class="card-header">
                <i class="fas fa-table"></i>
                Access Power</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr style="text-align: center;">
                            <th width="5%">SL NO</th>
                            <th>CRM</th>
                            <th>Money Transfere</th>
                            <th>Name</th>
                            <span style="color: red"> {{ $errors->has('full_name') ? $errors->first('full_name') : ' ' }}</span>
                            <th>Email</th>
                            <th>Phone</th>
                            <span style="color: red"> {{ $errors->has('phone') ? $errors->first('phone') : ' ' }}</span>
                            <th>Secondary Phone</th>
                            <span style="color: red"> {{ $errors->has('second_phone') ? $errors->first('second_phone') : ' ' }}</span>
                            <th>Nationality</th>
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
                            <th>Money Status</th>
                            <th>CRM Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customer_access as $key => $info)
                            <tr style="text-align: center;">
                                <td width="5%">{{ $key+1 }}</td>
                                <td>
                                    @if(isset($info->crm))
                                        {{ $info->crm }}
                                    @else
                                        <b style="color: red;">NA</b>
                                    @endif
                                </td>
                                <td>
                                    @if(isset($info->money_transfer))
                                        {{ $info->money_transfer }}
                                    @else
                                        <b style="color: red;">NA</b>
                                    @endif
                                </td>
                                <td>
                                    @if(isset($info->full_name))
                                        {{ $info->full_name }}
                                    @else
                                        <b style="color: red;">NA</b>
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

                                <td>
                                        @if($info->money_status ==1)
                                            <span class="badge badge-success">Permitted</span>
                                        @else
                                            <span class="badge badge-warning">Pending</span>
                                        @endif
                                </td>
                                <td>
                                    @if($info->crm_status ==1)
                                        <span class="badge badge-success">Permitted</span>
                                    @else
                                        <span class="badge badge-warning">Pending</span>
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