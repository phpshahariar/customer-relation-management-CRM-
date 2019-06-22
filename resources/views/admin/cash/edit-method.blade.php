@extends('admin.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                @if(Session::get('message'))
                    <h5 class="alert alert-success">{{ Session::get('message') }}</h5>
                @endif
                <div class="card-header">
                    <h5>Payment Method</h5>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('/method/update') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{!! $edit_method->id !!}" name="id" id="id">
                            <div class="form-group">
                                <label>Method Name</label>
                                <input type="text" value="{!! $edit_method->method_name !!}" class="form-control" name="method_name" id="method_name" aria-describedby="emailHelp" placeholder="Enter Method Name...">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control"  name="method_description" id="editor1">{!! $edit_method->method_description !!}</textarea>
                            </div>
                            <a href="{{ url('/cashin/method') }}"  class="btn btn-danger">Back</a>
                            <button type="submit" name="btn" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="//cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace( 'editor1' );
    </script>


@endsection