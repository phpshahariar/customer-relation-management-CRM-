@extends('admin.master')

@section('content')
    <div class="container">
        @if(Session::get('message'))
            <h3 class="alert alert-success">{{ Session::get('message') }}</h3>
        @endif
        <div style="margin-left: 20px;">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#CampaignLow">
                Campaign Low
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="CampaignLow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Campaign Low</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('/save/campaign/low') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Campaign Low : </label>
                                <textarea class="form-control" name="campaign_low" id="editor1"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" name="btn" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <div class="card">
            <!-- Button trigger modal -->
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr style="text-align: center">
                        <th>SL</th>
                        <th style="width: 220px;">Campaign Low</th>
                        <th>Status</th>
                        <th width="8%">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- script-->
    <script src="//cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace( 'editor1' );
    </script>

@endsection
