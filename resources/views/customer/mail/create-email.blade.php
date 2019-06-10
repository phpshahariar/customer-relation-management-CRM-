@extends('customer.master')

@section('content')
    <div class="container">
        @if(Session::get('message'))
            <h4 class="alert alert-success">{{Session::get('message')}}</h4>
        @endif

        <div class="card mb-3">
            <div class="card">
                <div class="card-header">
                    <h2>E-mail Send</h2>
                </div>
                <div class="card-body">
                    <form action="{{ url('/email/send') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>E-mail Address : </label>
                            <input type="text" required name="email" class="form-control" placeholder="Enter Valid Email Address....">
                            <input type="hidden" value="{{ Auth::user()->account_number }}" required name="user_account" class="form-control">
                            <input type="hidden" value="{{ Auth::user()->id }}" required name="user_id" class="form-control">
                            <span style="color: red"> {{ $errors->has('email') ? $errors->first('email') : ' ' }}</span>
                        </div>
                        <div class="form-group">
                            <label>Your Message : </label>
                            <textarea name="message" required id="editor1" class="form-control" placeholder="Enter Your Message"></textarea>
                            <span style="color: red"> {{ $errors->has('message') ? $errors->first('message') : ' ' }}</span>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="btn" class="btn btn-success" value="Send">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="//cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'editor1' );
    </script>
@endsection