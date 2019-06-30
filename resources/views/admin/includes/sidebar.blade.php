<ul class="sidebar navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('admin/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-arrow-alt-circle-right"></i>
            <span>ReSeller Point</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="{{ url('/reseller/campaign') }}">Campaign Request</a>
            <a class="dropdown-item" href="#">Send SMS List</a>
            <a class="dropdown-item" href="{{ url('/reseller/send/mail') }}">Send Email List</a>
            <a class="dropdown-item" href="{{ url('/reseller/recharge') }}">Re-Seller Recharge</a>
            <a class="dropdown-item" href="{{ url('/reseller/list') }}">Reseller List</a>
            <a class="dropdown-item" href="#">Money Transfer</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="customerDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-arrow-alt-circle-right"></i>
            <span>Customer Point</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="customerDropdown">
            <a class="dropdown-item" href="{{ url('/customer/campaign') }}">Campaign Request</a>
            <a class="dropdown-item" href="#">Send SMS List</a>
            <a class="dropdown-item" href="{{ url('/customer/mail/list') }}">Send Email List</a>
            <a class="dropdown-item" href="{{ url('/customer/cashin') }}">CashIn Request</a>
            <a class="dropdown-item" href="{{ url('/customer/access/power') }}">Access Power</a>
            <a class="dropdown-item" href="{{ url('/customer/list') }}">Customer List</a>
            <a class="dropdown-item" href="{{ url('/customer/cash/out') }}">Customer Cash Out</a>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/campaign/low') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Campaign Low</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/cashin/method') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Cash In Method</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/category/page') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Category Page</span></a>
    </li>
</ul>