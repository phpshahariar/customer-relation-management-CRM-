<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Chating</title>
</head>
<body>

<div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <a class="btn btn-danger" href="{{ url('/crm/list') }}">Back</a>
    </nav>

    <nav class="navbar navbar-expand-lg navbar-dark bg-light" style="margin-top: 10px;">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item active">
                    <a class="btn btn-info" style="margin-left: 30px;" data-toggle="modal" data-target="#smsModal" href="#">SMS</a>
                </li>
                <li class="nav-item" style="margin-left: 30px;">
                    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#emailModal">Email</a>
                </li>
                <li class="nav-item" style="margin-left: 30px;">
                    <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#alertModal">Alert</a>
                </li>
                {{--                                            <li class="nav-item" style="margin-left: 30px;">--}}
                {{--                                                <a class="btn btn-warning" href="#" data-toggle="modal" data-target="#priorityModal">Priority</a>--}}
                {{--                                            </li>--}}
            </ul>
        </div>
    </nav>
    {{--        <table>--}}
    {{--            <tr>--}}
    {{--                <td>--}}
    {{--                    <label>Input Phone Number</label>--}}
    {{--                    <input type="text" name="phone_number"  class="form-control phone_number" placeholder="Searching....">--}}
    {{--                </td>--}}
    {{--            </tr>--}}
    {{--        </table>--}}
    <style>
        .tab-content {
            background: #ffffff none repeat scroll 0 0;
            height: 470px;
            overflow: auto;
            padding: 17px 15px;
            border: 1px solid lightgray;
        }
    </style>
    <br/>
    <br/>
    <div class="col-md-12" style="margin-bottom: 30px;">
        @if(Session::get('message'))
            <p class="alert alert-success" style="text-align: center;">{{ Session::get('message') }}</p>
        @endif

        <div class="row mx-auto">
            <div class="col-md-6">
                <form action="{{ url('/chating') }}" method="post">
                    @csrf
                    <textarea name="chating" rows="20" class="form-control">{{ $profile->chating }}</textarea>
                    <br/>
                    <br/>

                    {{--                            <input type="hidden" name="phone_number" class="form-control" value="{{ Auth::user()->phone_number }}">--}}
                    {{--                            <span style="color: red"> {{ $errors->has('chating') ? $errors->first('chating') : ' ' }}</span>--}}
                    <br/>
                </form>
            </div>
            <div class="col-md-6">
                <form action="{{url('save/customer/information')}}" method="post" id="updateData">
                    @csrf
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tbody>
                                    <tr>
                                        <td >
                                            <label>Name</label>
                                            <input type="text"  name="name" value="{{ $profile->name }}" class="form-control name" placeholder="Enter Name....">
                                            <input type="hidden"  name="customer_id" class="form-control customer_id">
                                            <span style="color: red"> {{ $errors->has('district') ? $errors->first('district') : ' ' }}</span>
                                        </td>
                                        <td>
                                            <label>Company</label>
                                            <input type="text" value="{{ $profile->company_name }}"  name="company_name" class="form-control company" placeholder="Enter Company....">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td id="more">
                                            <label>Phone</label>
                                            <input type="number" value="{{ $profile->phone }}"  name="phone" id="phone" class="form-control phoneNumber" placeholder="Enter Phone number....">
                                        </td>
                                        <td id="emailMore">
                                            <label>E-mail</label>
                                            <input type="email"  name="email_address" value="{{ $profile->email_address }}" class="form-control email" placeholder="Enter Email....">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>District</label>
                                            <input type="text"  name="district" value="{{ $profile->district }}" class="form-control district" placeholder="Enter District....">
                                            <span style="color: red"> {{ $errors->has('district') ? $errors->first('district') : ' ' }}</span>
                                        </td>
                                        <td>
                                            <label>Area</label>
                                            <input type="text"  name="area" value="{{ $profile->area }}" class="form-control area" placeholder="Enter Area....">
                                            <span style="color: red"> {{ $errors->has('area') ? $errors->first('area') : ' ' }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td id="moreService">
                                            <label>Service</label>
                                            <input type="text"  name="service" value="{{ $profile->service }}" class="form-control service" placeholder="Enter Service....">
                                            <span style="color: red"> {{ $errors->has('area') ? $errors->first('area') : ' ' }}</span>
                                        </td>
                                        <td>
                                            <label>Created By : </label>
                                            <input type="text" readonly class="form-control createdBy" name="created_by" value="{{ $profile->created_by }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Address</label>
                                            <input type="text"  name="address" value="{{ $profile->address }}" class="form-control address" placeholder="Enter Address....">
                                        </td>
                                        <td>
                                            <label>Note</label>
                                            <input type="text"  name="notes" value="{{ $profile->notes }}" class="form-control note" placeholder="Enter Notes....">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Customer By : </label>
                                            <input type="text" name="customer_by" value="{{ $profile->customer_by }}" class="form-control customerBy">
                                        </td>
                                        <td>
                                            <label>Date</label>
                                            <input type="text" class="form-control created_at" name="created_at" value="{{ $profile->created_at }}">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="4" name="chating" placeholder="Input Your Text...."></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success btn-block" name="btn" value="SubmiT">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


{{--    sms modal start--}}

<div class="modal fade" id="smsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">SMS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/customer/service/sms') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Number</label>
                        <input type="text" name="number" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea class="form-control" name="message" rows="4px"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" name="btn" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{--    sms modal end--}}

{{--    email modal start--}}

<div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('/email/send')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea class="form-control" name="message" rows="4"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" name="btn" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{--    email modal end--}}

{{--    email modal start--}}

<div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Alert</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('/alert/send')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Alert</label>
                        <input type="date" name="alert_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea class="form-control" name="message" rows="4"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{--    email modal end--}}


<!-- Optional JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
{{--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script type="text/javascript">
    $('.phone_number').keyup(function () {
        var phone = $(this).val();
        $.ajax({
            type:'GET',
            url: "{{ url('customer/reg/info') }}",
            data:{phone:phone},
            success:function (data) {
                // console.log(data);
                $('.customer_id').val(data.id);
                $('.customerBy').val(data.customer_by);
                $('.name').val(data.name);
                $('.company').val(data.company_name);
                $('#phone').val(data.phone);
                $('.email').val(data.email_address);
                $('.district').val(data.district);
                $('.area').val(data.area);
                $('.address').val(data.address);
                $('.service').val(data.service);
                $('.note').val(data.notes);
                $('.created_at').val(data.created_at);
                $('.createdBy').val(data.created_by);
                $('#history').text(data.chating);
            }
        });
    });

    $('.phone_number_chat').keyup(function () {
        var phone = $(this).val();
        var bk = '';
        $.ajax({
            type:'GET',
            url: "{{ url('customer/chat/info') }}",
            data:{phone:phone},
            success:function (data) {
                $('.content_text').html(data);


            }
        });
    });
</script>
</body>
</html>