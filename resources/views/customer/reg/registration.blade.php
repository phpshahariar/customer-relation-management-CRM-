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
            <a class="btn btn-danger" href="{{ url('/home') }}">Back</a>
        </nav>
        <style>
            .tab-content {
                background: #ffffff none repeat scroll 0 0;
                height: 400px;
                overflow: auto;
                padding: 17px 15px;
            }
        </style>
        <div class="col-md-12" style="margin-bottom: 30px;">
            <div class="row">
                <div class="col-md-6">
                    <div class="col-md-12 tab-content" >
                        @foreach($show_history as $history)
                            <p>{!! $history->chating !!}</p>
                        @endforeach
                    </div>
                    <form action="{{ url('/chating') }}" method="POST">
                        @csrf
                        <textarea class="form-control" rows="4" name="chating" placeholder="Input Your Text...."></textarea>
                        <input type="submit" name="btn" class="btn btn-success" value="Send" style="width: 150px; margin-top: 10px;">
                        <span style="color: red"> {{ $errors->has('chating') ? $errors->first('chating') : ' ' }}</span>
                    </form>
                    <br/>
                    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item active">
                                    <a class="btn btn-success" data-toggle="modal" data-target="#smsModal" href="#">SMS</a>
                                </li>
                                <li class="nav-item" style="margin-left: 30px;">
                                    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#emailModal">Email</a>
                                </li>
                                <li class="nav-item" style="margin-left: 30px;">
                                    <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#alertModal">Alert</a>
                                </li>
                                <li class="nav-item" style="margin-left: 30px;">
                                    <a class="btn btn-warning" href="#" data-toggle="modal" data-target="#priorityModal">Priority</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="col-md-6">
                    <form>
                        <div class="card">
                        <div class="card-body">
                        <table class="table table-borderless">
                            <tbody>
                            <tr>
                                <td>
                                    <label>Input Phone Number</label>
                                    <input type="text" name="search" class="form-control" placeholder="Searching....">
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    <label>Name</label>
                                    <input type="text" readonly name="name" class="form-control" placeholder="Enter Name....">
                                </td>
                                <td>
                                    <label>Company</label>
                                    <input type="text" readonly name="company" class="form-control" placeholder="Enter Company....">
                                </td>
                            </tr>
                            <tr>
                                <td id="more">
                                    <label>Phone</label>
                                    <input type="number" readonly name="phone" class="form-control phoneNumber" placeholder="Enter Phone number....">
                                </td>
                                <td>
                                    <label></label>
                                    <button type="button" class="btn btn-success phone" style="width: 50px; margin-top: 30px;">+</button>
                                </td>
                            </tr>
                            <tr>
                                <td id="emailMore">
                                    <label>E-mail</label>
                                    <input type="email" readonly name="email" class="form-control" placeholder="Enter Email....">
                                </td>
                                <td>
                                    <label></label>
                                    <button type="button" id="email" class="btn btn-success moreEmail" style="width: 50px; margin-top: 30px;">+</button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>District</label>
                                    <input type="text" name="district" class="form-control" readonly>
                                </td>
                                <td>
                                    <label>Area</label>
                                    <input type="text" name="area" class="form-control" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td id="moreService">
                                    <label>Service</label>
                                    <input type="text" readonly name="service" class="form-control " placeholder="Enter Service....">
                                </td>
                                <td>
                                    <label></label>
                                    <button type="button" class="btn btn-success addService" style="width: 50px; margin-top: 30px;">+</button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Address</label>
                                    <textarea class="form-control" readonly name="address" rows="5"></textarea>
                                </td>
                                <td>
                                    <label>Note</label>
                                    <textarea class="form-control" readonly name="note" rows="5"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Customer By : </label>
                                    <input type="text" name="customer_by" class="form-control" readonly>
                                </td>
                                <td>
                                    <label>Date</label>
                                    <input type="date" readonly class="form-control" name="create_date">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                        </div>
                        <div class="form-group">
                            <label>Created By : </label>
                            <b class="createdBy"></b>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success btn-block" name="btn" value="SubmiT">
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
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label>Number</label>
                            <input type="number" name="number" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea class="form-control" name="message" rows="4px"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Send</button>
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
                    <form action="" method="post">
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
                            <button type="button" class="btn btn-primary">Send</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label>Alert</label>
                            <input type="date" name="alert" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea class="form-control" name="message" rows="4"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--    email modal end--}}


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

    <script>
        $(document).ready(function () {
            $(".phone").click(function () {
                addRow();
            });
            
            function addRow() {
                var add = '<tr>\n' +
                    '                                <td id="more">\n' +
                    '                                    <label>Phone</label>\n' +
                    '                                    <input type="number" name="phone" class="form-control phoneNumber" placeholder="Enter Phone number....">\n' +
                    '                                </td>\n' +
                    '                                <td>\n' +
                    '                                    <label></label>\n' +
                    '                                    <button type="button" class="btn btn-danger remove" style="margin-top: 30px;">Remove</button>\n' +
                    '                                </td>\n' +
                    '                            </tr>'

                $("#more").append(add);
            }

        $(".moreEmail").click(function () {
           addEmail();
        });

            function addEmail() {
                var moreEmail = '<tr>\n' +
                    '                                <td id="emailMore">\n' +
                    '                                    <label>E-mail</label>\n' +
                    '                                    <input type="email" name="email" class="form-control"  placeholder="Enter Email....">\n' +
                    '                                </td>\n' +
                    '                                <td>\n' +
                    '                                    <label></label>\n' +
                    '                                    <button type="button" id="email" class="btn btn-danger emailRemove" style="margin-top: 30px;">Remove</button>\n' +
                    '                                </td>\n' +
                    '                            </tr>'

                $("#emailMore").append(moreEmail);
            }

            $(".addService").click(function () {
                moreService();
            });
            function moreService() {
                var service = '<tr>\n' +
                    '                                <td id="moreService">\n' +
                    '                                    <label>Service</label>\n' +
                    '                                    <input type="text" name="service" class="form-control " placeholder="Enter Service....">\n' +
                    '                                </td>\n' +
                    '                                <td>\n' +
                    '                                    <label></label>\n' +
                    '                                    <button type="button" class="btn btn-danger removeService" style="margin-top: 30px;">Remove</button>\n' +
                    '                                </td>\n' +
                    '                            </tr>'

                $("#moreService").append(service);
            }
        });
    </script>

    <script>
        $(document).click(function () {
            $(".remove").click(function () {
                $(this).parent().parent().remove();
            });
        });
    </script>
    <script>
        $(document).click(function () {
            $(".emailRemove").click(function () {
                $(this).parent().parent().remove();
            });
        });
    </script>
    <script>
        $(document).click(function () {
            $(".removeService").click(function () {
                $(this).parent().parent().remove();
            });
        });
    </script>



</html>