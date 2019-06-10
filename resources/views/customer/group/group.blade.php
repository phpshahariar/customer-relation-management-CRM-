@extends('re-sellar.master')

@section('content')

    <div class="container">
        @if(Session::get('message'))
            <h3 class="alert alert-success">{{ Session::get('message') }}</h3>
        @endif
        <div style="margin-left: 20px;">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#CreateGroup">
                Add Group
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="CreateGroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ Session::get('name') }} Group Create</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('/save/customer/group') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Group Name : </label>
                                <input type="text" name="group_name" required id="group_name" class="form-control" placeholder="Group name">
                                <input type="hidden" value="{{ Auth::user()->account_number }}" required name="user_account" class="form-control">
                                <input type="hidden" value="{{ Auth::user()->id }}" required name="user_id" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Group Name : </label>
                                <select class="form-control" required name="status">
                                    <option>---- Select Status ----</option>
                                    <option value="1">Active</option>
                                    <option value="0">Pending</option>
                                </select>
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
                            <th>Group Name</th>
                            <th>Status</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
{{--                    @foreach($all_group as $key => $group)--}}
{{--                        <tr style="text-align: center">--}}
{{--                            <td>{{ $key+1 }}</td>--}}
{{--                            <td>{{ $group->group_name }}</td>--}}
{{--                            <span style="color: red"> {{ $errors->has('group_name') ? $errors->first('group_name') : ' ' }}</span>--}}
{{--                            <td>{{ $group->status ==1 ? 'Active' : 'Pending' }}</td>--}}
{{--                            <td width="15%">--}}
{{--                                @if($group->status ==1)--}}
{{--                                <a href="{{ url('/active/group/'.$group->id) }}" class="badge badge-info">--}}
{{--                                    <span class="fa fa-arrow-alt-circle-up"></span>--}}
{{--                                </a>--}}
{{--                                @else--}}
{{--                                <a href="{{ url('/pending/group/'.$group->id) }}" class="badge badge-warning">--}}
{{--                                    <span class="fa fa-arrow-alt-circle-down"></span>--}}
{{--                                </a>--}}
{{--                                @endif--}}
{{--                                <a href="{{ url('/delete/group/'.$group->id) }}" onclick="return confirm('Are You Sure This Group?')" class="badge badge-danger">--}}
{{--                                    <span class="fa fa-trash"></span>--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                     @endforeach--}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection