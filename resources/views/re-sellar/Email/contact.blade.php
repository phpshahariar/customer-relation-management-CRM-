@extends('re-sellar.master')

@section('content')
    <div class="container">
        @if(Session::get('message'))
            <h4 class="alert alert-success">{{ Session::get('message') }}</h4>
        @endif
            <div class="card-body">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                    Upload
                </button>
                <br/>
                <br/>
                <select class="form-control" required name="group_id" id="group_id">
                    <option> --- Select Group --- </option>
                    @foreach($show_group as $group)
                        <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                    @endforeach
                </select>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ Session::get('name') }} Export & Import File</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label>Group Name : </label>
                                        <select class="form-control" required name="group_id" id="group_id">
                                            <option>--- Select Group ---</option>
                                            @foreach($show_group as $group)
                                                <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Only For Excel File Upload : </label>
                                        <input type="file" required name="upload_file">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="btn" class="btn btn-primary">Import</button>
                                        <a class="btn btn-warning" href="{{ route('export') }}">Download</a>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Contact Table</div>
                <div class="card-body">
                    <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>SL NO</th>
                                    <th>Group Name</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th width="20%">E-mail</th>
                                </tr>
                                </thead>

                                    <tbody id="show_by_group">
                                    @php($i = 0)
                                    @foreach($show_contact as $contact)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            @if(isset($contact->group->group_name))
                                                <td>{{ $contact->group->group_name }}</td>
                                            @else
                                                <td>Group Name Not Found</td>
                                            @endif
                                            @if(isset($contact->name))
                                                <td>{{ $contact->name }}</td>
                                            @else
                                                <td>Name Not Found</td>
                                            @endif
                                            @if(isset($contact->phone))
                                                <td>{{ $contact->phone }}</td>
                                            @else
                                                <td>Phone Number Not found</td>
                                            @endif
                                            @if(isset($contact->email))
                                                <td width="20%">{{ $contact->email }}</td>
                                             @else
                                                <p>Email Not Found</p>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>

                            </table>
                            <form action="{{ url('/group/mail') }}" method="post">
                                @csrf
                                <input type="submit" name="btn" class="btn btn-danger" value="Group Mail Send">
                            </form>
                    </div>
                </div>
            </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    
    <script>
        $(document).ready(function () {
            $('#group_id').on('change', function () {
                var id = $(this).val();
                $.ajax({
                    url: "{{url('/group-data')}}/" + id,
                    type: "GET",
                    data: {id: id},
                    success:function (data) {
                        $('#show_by_group').html(data);
                    }
                });
            });
        })
    </script>

@endsection