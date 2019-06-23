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
                        <th>Campaign Low</th>
                        <th width="20%">Status</th>
                        <th width="20%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($show_low as $key => $low)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{!! substr($low->campaign_low,0,330) !!} ....</td>
                                <td style="text-align: center;">{!! $low->status ==1 ? 'Active' : 'Not Active'!!}</td>
                                <td style="text-align: center;">
                                    @if($low->status ==1)
                                    <a href="{{ url('/active/low/'.$low->id) }}" class="badge badge-primary">Active</a>
                                    @else
                                    <a href="{{ url('/not/active/low/'.$low->id) }}" class="badge badge-warning">Not Active</a>
                                    @endif
                                    <a href="{{ url('/delete/low/'.$low->id) }}" class="badge badge-danger" onclick="return confirm('Are You Sure Delete This Low!?')">Delete</a>
                                </td>
                            </tr>
                        @endforeach
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
