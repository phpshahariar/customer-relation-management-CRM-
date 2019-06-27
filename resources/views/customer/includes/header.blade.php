<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="#">Relation Management</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>
    &nbsp;&nbsp;&nbsp;&nbsp;<div class="mr-5 badge badge-primary">
            <h5 style="color: white;">A/C : {{ Auth::user()->account_number }}</h5>
        </div>

    @if($totalCost > 0)
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <div class="mr-5 badge badge-success">
            <h5>Total : {{ number_format($totalCashOut,2) }} Tk.</h5>
        </div>
    @else
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <div class="mr-5 badge badge-warning">
            <h5>Total : 00.00 Tk.</h5>
        </div>
    @endif
    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
            <h3 id="clock" style="color: white"></h3>
            <div class="input-group-append"></div>
        </div>
    </form>

    <script>
        var myVar = setInterval(myTimer ,1000);
        function myTimer() {
            var d = new Date();
            document.getElementById("clock").innerHTML = d.toLocaleTimeString();
        }
    </script>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">


        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->name }} <i class="fas fa-user-circle fa-fw"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ url('/setting/option') }}">Settings</a>
                <a class="dropdown-item"></a>
{{--                @if (Route::has('register'))--}}
{{--                    <a class="dropdown-item" href="{{ route('register') }}">Register</a>--}}
{{--                @endif--}}
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>

</nav>