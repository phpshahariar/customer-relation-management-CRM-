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

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Export & Import File</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
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
                                <tbody>
                                @foreach($show_contact as $key => $contact)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $contact->group_name }}</td>
                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->phone }}</td>
                                        <td width="20%">{{ $contact->email }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <form action="{{ url('/group/mail') }}" method="post">
                                @csrf
                                <input type="submit" class="btn btn-danger" value="Group Mail Send">
                            </form>
                    </div>
                </div>
            </div>

    </div>
@endsection