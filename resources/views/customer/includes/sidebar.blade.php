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
            <a class="dropdown-item" href="login.html">Create</a>
            <a class="dropdown-item" href="register.html">Inbox</a>
            <a class="dropdown-item" href="forgot-password.html">Send</a>
            <a class="dropdown-item" href="forgot-password.html">Draft</a>
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
            <a class="dropdown-item" href="login.html">Create</a>
            <a class="dropdown-item" href="register.html">Inbox</a>
            <a class="dropdown-item" href="forgot-password.html">Send</a>
            <a class="dropdown-item" href="forgot-password.html">Draft</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="voiceDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-mail-bulk"></i>
            <span>Voice Mail</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="voiceDropdown">
            <a class="dropdown-item" href="login.html">Create</a>
            <a class="dropdown-item" href="register.html">Inbox</a>
            <a class="dropdown-item" href="forgot-password.html">Send</a>
            <a class="dropdown-item" href="forgot-password.html">Draft</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="moneyDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-money-bill"></i>
            <span>Money Transfer</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="moneyDropdown">
            <a class="dropdown-item" href="login.html">Create</a>
            <a class="dropdown-item" href="register.html">Inbox</a>
            <a class="dropdown-item" href="forgot-password.html">Send</a>
            <a class="dropdown-item" href="forgot-password.html">Draft</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="crmDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-rainbow"></i>
            <span>CRM</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="crmDropdown">
            <a class="dropdown-item" href="{!! url('/create/mail') !!}">Create</a>
            <a class="dropdown-item" href="register.html">Inbox</a>
            <a class="dropdown-item" href="forgot-password.html">Send</a>
            <a class="dropdown-item" href="forgot-password.html">Draft</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="crmDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="far fa-money-bill-alt"></i>
            <span>CashIn</span>
        </a>
    </li>
</ul>