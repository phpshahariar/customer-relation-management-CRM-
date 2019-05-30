@extends('re-sellar.master')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="card-header">
                    <h2 style="text-align: center; color: darkgreen">Introduction for Product Marketing</h2>
                </div>
                <br>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <p>
                                        Best Booking SystemBest Booking SystemBest Booking SystemBest Booking SystemBest Booking SystemBest
                                        Booking SystemBest Booking SystemBest Booking SystemBest Booking SystemBest Booking SystemBest
                                        Booking SystemBest Booking SystemBest
                                        Booking SystemBest Booking SystemBest Booking SystemBest Booking SystemBest Booking System
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <form action="{{ url('/add/campaign') }}" method="POST">
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Start Date : </label>
                                                <input type="date" class="form-control" name="start_date" id="start_date">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>End Date : </label>
                                                <input type="date" class="form-control" name="end_date" id="end_date">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Page Link : </label>
                                                <input type="text" class="form-control" name="link" id="link">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Amount : </label>
                                                <input type="number" class="form-control" name="amount" id="amount">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Filtering</label>
                                            <textarea type="text" class="form-control" name="filtering" id="filtering" placeholder="Filtering....."></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block">SubmiT</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
                <br>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="btn btn-md btn-danger" style="width: 130px;" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Back</a>
                                </li>
                                <li class="nav-item" style="margin-left: 20px;">
                                    <a class="btn btn-md btn-primary" style="width: 130px;" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Next</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection