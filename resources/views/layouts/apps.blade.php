<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Customer RelationShip</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="background-image: url({{ asset('/assets/') }}/Sunset.png);">
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-danger shadow-sm" style="height: 100px;">
        <div class="container">
            <a class="navbar-brand" style="font-size: 34px; color: #ffffff;" href="{{ url('/') }}">
                Customer RelationShip
            </a>
            @foreach($pages as $page)
                <a class="navbar-brand btn btn-warning" style="font-size: 18px; color: black;" href="{{ url('/page/description/'.$page->id) }}">
                    {{ $page->name }}
                </a>
            @endforeach
            <form method="POST" action="{{ route('login') }}" style="margin-top: 50px;">
                @csrf
                <table class="table table-borderless" style="margin-left: 50px;">
                    <tr>
                        <td>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input id="email" placeholder="Enter Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input id="password" placeholder="Enter Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <a href="{{ route('password.request') }}" style="color: white; margin-left: 10px; margin-top: 10px;">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                            </div>
                        </td>
                        <td width="10%">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>
                        </td>
                    </tr>
                </table>
            </form>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        {{--                            <li class="nav-item">--}}
                        {{--                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
                        {{--                            </li>--}}
                        {{--                            @if (Route::has('register'))--}}
                        {{--                                <li class="nav-item">--}}
                        {{--                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
                        {{--                                </li>--}}
                        {{--                            @endif--}}
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</div>
<main class="py-4">
    @yield('content')
</main>
</body>
</html>
