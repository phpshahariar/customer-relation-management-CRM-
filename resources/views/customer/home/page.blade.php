<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Category Page!</title>
</head>
<body style="background-image: url({{ asset('/assets/') }}/Sunset.png);">
<br/>
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="col-md-12" style="height: 90px; background-color: orangered;">
                <div class="row">
                    <div class="col-md-4">
                        <a href="{{url('/')}}" style="font-size: 25px; font-weight: bold; color: white; text-decoration: none;">Customer Relationship</a>
                    </div>
                    <div class="col-md-8">
                        @foreach($all_category_name as $category_page)
                            <a href="{{url('/page/description/'.$category_page->id)}}" class="navbar-brand btn btn-primary" style="font-size: 18px; color: white; margin-top: 20px;">{{ $category_page->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h3>Page Description</h3>
                    <hr/>
                    @foreach($show_category_page as $description)
                        <p>{!! $description->description !!}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>