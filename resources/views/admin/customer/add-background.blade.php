@extends('admin.master')

@section('content')
    <div class="container">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#categoryPage">
            Add Image
        </button>
        <br/>
        <br/>
        @if($message = Session::get('message'))
            <p class="alert alert-success" style="text-align: center;">{{$message}}</p>
        @endif
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Background Images Table</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr style="text-align: center;">
                            <th>SL NO</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th width="8%">Status</th>
                            <th width="20%">Action</th>
                        </tr>
                        </thead>
                        <tbody id="show_by_group">
                        @foreach($show_background as $key => $background)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{!! substr($background->description,0,120) !!} ....</td>
                                <td>
                                    <img src="{{ asset('/background-images/'.$background->image) }}" height="50" width="100"/>
                                </td>
                                <td style="text-align: center;">{!! $background->status == 1 ? 'Active' : 'Inactive'!!}</td>
                                <td style="text-align: center;">
                                    @if($background->status == 1)
                                    <a href="{{ url('/active/background/' .$background->id) }}" class="badge badge-success">Active</a>
                                    @else
                                    <a href="{{ url('/inactive/background/' .$background->id) }}" class="badge badge-warning">Inactive</a>
                                    @endif
                                    <a href="{{ url('/edit/background/' .$background->id) }}" class="badge badge-info">Edit</a>
                                    <a href="{{ url('/delete/background/' .$background->id) }}" class="badge badge-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="categoryPage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Background</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('/save/background') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" required id="editor1" class="form-control" placeholder="Enter Your Message"></textarea>
                                <span style="color: red"> {{ $errors->has('description') ? $errors->first('description') : ' ' }}</span>
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="image" id="image" accept="image/*">
                                <span style="color: red"> {{ $errors->has('image') ? $errors->first('image') : ' ' }}</span>
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
    </div>

    {{--    Script--}}
    <script src="//cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'editor1' );
    </script>
@endsection