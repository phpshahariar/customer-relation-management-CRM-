<ul class="sidebar navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-sms"></i>
            <span>SMS System</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="{!! url('/create/customer/sms') !!}">Create</a>
            <a class="dropdown-item" href="#">Inbox</a>
            <a class="dropdown-item" href="{!! url('/send/customer/sms/list') !!}">Send</a>
            <a class="dropdown-item" href="{!! url('/send/customer/group/list') !!}">Group SMS</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="emailDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-envelope"></i>
            <span>Email System</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="emailDropdown">
            <a class="dropdown-item" href="{!! url('/create/mail') !!}">Create</a>
            <a class="dropdown-item" href="#">Inbox</a>
            <a class="dropdown-item" href="{!! url('/send/list') !!}">Send List</a>
{{--            <a class="dropdown-item" href="forgot-password.html">Draft</a>--}}
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="fbDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="far fa-user"></i>
            <span>Contact List</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="{{ url('/create/customer/group') }}">Create Group</a>
            <a class="dropdown-item" href="{{ url('/contact/customer/list') }}">Upload Group File</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="fbDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fab fa-facebook"></i>
            <span>Facebook</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="fbDropdown">
            <a class="dropdown-item" href="{{ url('/customer/facebook/boost') }}">Create Campaign</a>
            <a class="dropdown-item" href="{{ url('/customer/manage/campaign') }}">Manage Campaign</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="voiceDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-mail-bulk"></i>
            <span style="color: red">Voice Mail</span>
        </a>
{{--        <div class="dropdown-menu" aria-labelledby="voiceDropdown">--}}
{{--            <a class="dropdown-item" href="#">Create</a>--}}
{{--            <a class="dropdown-item" href="#">Inbox</a>--}}
{{--            <a class="dropdown-item" href="#">Send</a>--}}
{{--            <a class="dropdown-item" href="#">Draft</a>--}}
{{--        </div>--}}
    </li>
    @foreach($customer_access as $access)
        @if($access->status == 1)
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="moneyDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-fw fa-money-bill"></i>
                    <span>{{ $access->money_transfer }} <p class="badge badge-danger">New</p></span>
                </a>
                <div class="dropdown-menu" aria-labelledby="moneyDropdown">
                    <a class="dropdown-item" href="{{ url('/cashin/request') }}">CashIn</a>
                    <a class="dropdown-item" href="{{ url('/send/money') }}">Send Money</a>
                    <a class="dropdown-item" href="{{ url('/cash/out/money') }}">Cash Out</a>
                </div>
            </li>
        @else
        @endif
    @endforeach
    @foreach($customer_access as $access)
        @if($access->status == 1)
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="crmDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-rainbow"></i>
             <span>{{ $access->crm }} <p class="badge badge-danger">New</p></span>
        </a>
        <div class="dropdown-menu" aria-labelledby="crmDropdown">
            <a class="dropdown-item" href="#">Need Requirement</a>
            <a class="dropdown-item" href="#">Need Requirement</a>
            <a class="dropdown-item" href="#">Need Requirement</a>
            <a class="dropdown-item" href="#">Need Requirement</a>
        </div>
    </li>
        @else
        @endif
    @endforeach
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="cashDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="far fa-money-bill-alt"></i>
            <span>CashIn</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="cashDropdown">
            <a class="dropdown-item" href="{{ url('/cashin/request') }}">CashIn Request</a>
        </div>
    </li>
</ul>