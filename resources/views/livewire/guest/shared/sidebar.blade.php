<div class="col-lg-3 col-md-4 col-12 border-end d-none d-md-block">
    <div class="pt-10 pe-lg-10">
        <!-- nav -->
        <ul class="nav flex-column nav-pills nav-pills-dark">
            <!-- nav item -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('user.orders') ? 'active' : '' }}" aria-current="page"
                    href="account-orders.html">
                    <i class="feather-icon icon-shopping-bag me-2"></i>
                    Your Orders
                </a>
            </li>
            <!-- nav item -->
            <li class="nav-item">
                <a class="nav-link" href="#!">
                    <i class="feather-icon icon-settings me-2"></i>
                    Settings
                </a>
            </li>
            {{-- <!-- nav item -->
            <li class="nav-item">
                <a class="nav-link" href="account-address.html">
                    <i class="feather-icon icon-map-pin me-2"></i>
                    Address
                </a>
            </li>
            <!-- nav item -->
            <li class="nav-item">
                <a class="nav-link" href="account-payment-method.html">
                    <i class="feather-icon icon-credit-card me-2"></i>
                    Payment Method
                </a>
            </li>
            <!-- nav item -->
            <li class="nav-item">
                <a class="nav-link" href="account-notification.html">
                    <i class="feather-icon icon-bell me-2"></i>
                    Notification
                </a>
            </li> --}}
            <!-- nav item -->
            <li class="nav-item">
                <hr />
            </li>
            <!-- nav item -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}">
                    <i class="feather-icon icon-log-out me-2"></i>
                    Log out
                </a>
            </li>
        </ul>
    </div>
</div>
