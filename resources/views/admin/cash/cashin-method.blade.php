@extends('admin.master')

@section('content')
    <div class="container">
        <a href="#" class="btn btn-success">Add Method</a>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Campaign Request</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr style="text-align: center;">
                            <th width="10%">SL NO</th>
                            <th>Payment Method</th>
                            <th>Method Description</th>
                            <th width="15%">Status</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection