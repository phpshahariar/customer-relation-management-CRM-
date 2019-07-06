@extends('customer.master')


@section('content')
    <div class="container">
        <div class="col-md-12 mx-auto">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header bg-success">
                                <h2>Single Voice SMS Service</h2>
                            </div>
                            <form action="#" method="POST">
                                <label>To :</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="to_number" id="to_number" placeholder="Enter Number">
                                </div>
                                <label>File :</label>
                                <div class="form-group">
                                    <input type="file" class="form-control" name="file" id="file">
                                </div>
                                <button type="button" class="btn btn-primary btn-block">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header bg-primary">
                                <h2>Group Voice SMS Service</h2>
                            </div>
                            <form action="#" method="POST">
                                <label>Select Group :</label>
                                <div class="form-group">
                                    <select class="form-control" name="group_id">
                                        <option>--- Select Group ---</option>
                                        <option value="0">Group</option>
                                    </select>
                                </div>
                                <label>File :</label>
                                <div class="form-group">
                                    <input type="file" class="form-control" name="file" id="file">
                                </div>
                                <button type="button" class="btn btn-success btn-block">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection