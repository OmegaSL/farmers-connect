<nav class="navbar navbar-expand-lg navbar-dark bg-primary py-0 py-lg-2 navbar-default">
    <div class="container-fluid">
        <div class="offcanvas offcanvas-start" tabindex="-1" id="navbar-default" aria-labelledby="navbar-defaultLabel">
            <div class="offcanvas-header pb-1">
                <a href="{{ url('/') }}"><img src="{{ asset('assets/images/logo/freshcart-logo.svg') }}"
                        alt="eCommerce HTML Template" /></a>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="d-block d-lg-none mb-4">
                    @livewire('guest.shared.header-search-filter-component')
                    {{-- <form action="#">
                        <div class="input-group">
                            <input class="form-control rounded" type="search" placeholder="Search for products" />
                            <span class="input-group-append">
                                <button class="btn bg-white border border-start-0 ms-n10 rounded-0 rounded-end"
                                    type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                </button>
                            </span>
                        </div>
                    </form> --}}
                    <div class="mt-2">
                        <button type="button" class="btn btn-outline-gray-400 text-muted w-100" data-bs-toggle="modal"
                            data-bs-target="#locationModal">
                            <i class="feather-icon icon-map-pin me-2"></i>
                            Pick Location
                        </button>
                    </div>
                </div>
                <div class="d-block d-lg-none mb-4">
                    <a class="btn btn-primary w-100 d-flex justify-content-center align-items-center"
                        data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
                        aria-controls="collapseExample">
                        <span class="me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-grid">
                                <rect x="3" y="3" width="7" height="7"></rect>
                                <rect x="14" y="3" width="7" height="7"></rect>
                                <rect x="14" y="14" width="7" height="7"></rect>
                                <rect x="3" y="14" width="7" height="7"></rect>
                            </svg>
                        </span>
                        All Departments
                    </a>
                    @php
                        $categories = \App\Models\ProductCategory::query()
                            ->with(['sub_categories'])
                            ->withCount([
                                'products' => function ($query) {
                                    $query->where('status', 'published');
                                },
                            ])
                            ->whereHas('products', function ($query) {
                                $query->where('status', 'published');
                            })
                            ->orderBy('products_count', 'desc')
                            ->where('status', 'active')
                            ->get()
                            ->take(8);
                    @endphp
                    <div class="collapse mt-2" id="collapseExample">
                        <div class="card card-body">
                            <ul class="mb-0 list-unstyled">
                                @foreach ($categories as $category)
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('shop.page.with.category', $category->slug) }}">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="dropdown me-3 d-none d-lg-block">
                    <button class="btn btn-primary px-6" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="me-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-grid">
                                <rect x="3" y="3" width="7" height="7"></rect>
                                <rect x="14" y="3" width="7" height="7"></rect>
                                <rect x="14" y="14" width="7" height="7"></rect>
                                <rect x="3" y="14" width="7" height="7"></rect>
                            </svg>
                        </span>
                        All Categories
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        @foreach ($categories as $category)
                            <li>
                                <a class="dropdown-item" href="{{ route('shop.page.with.category', $category->slug) }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <ul class="navbar-nav align-items-center navbar-offcanvas-color">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home.page') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('shop.page') }}">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('stores.page') }}">Stores</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about_us.page') }}">About us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact_us.page') }}">Contact</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">Account</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="account-orders.html">Orders</a></li>
                                <li><a class="dropdown-item" href="account-settings.html">Settings</a></li>
                                <li><a class="dropdown-item" href="account-address.html">Address</a></li>
                                <li><a class="dropdown-item" href="account-payment-method.html">Payment
                                        Method</a></li>
                                <li><a class="dropdown-item" href="account-notification.html">Notification</a>
                                </li>
                            </ul>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="dashboard/{{ url('/') }}">Dashboard</a>
                        </li> --}}
                        {{-- <li class="nav-item dropdown dropdown-flyout">
                            <a class="nav-link" href="#" id="navbarDropdownDocs" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Docs</a>
                            <div class="dropdown-menu dropdown-menu-lg" aria-labelledby="navbarDropdownDocs">
                                <a class="dropdown-item align-items-start" href="docs/{{ url('/') }}">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" class="bi bi-file-text text-primary"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z" />
                                            <path
                                                d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z" />
                                        </svg>
                                    </div>
                                    <div class="ms-3 lh-1">
                                        <h6 class="mb-1">Documentations</h6>
                                        <p class="mb-0 small">Browse the all documentation</p>
                                    </div>
                                </a>
                                <a class="dropdown-item align-items-start" href="docs/changelog.html">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" class="bi bi-layers text-primary"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M8.235 1.559a.5.5 0 0 0-.47 0l-7.5 4a.5.5 0 0 0 0 .882L3.188 8 .264 9.559a.5.5 0 0 0 0 .882l7.5 4a.5.5 0 0 0 .47 0l7.5-4a.5.5 0 0 0 0-.882L12.813 8l2.922-1.559a.5.5 0 0 0 0-.882l-7.5-4zm3.515 7.008L14.438 10 8 13.433 1.562 10 4.25 8.567l3.515 1.874a.5.5 0 0 0 .47 0l3.515-1.874zM8 9.433 1.562 6 8 2.567 14.438 6 8 9.433z" />
                                        </svg>
                                    </div>
                                    <div class="ms-3 lh-1">
                                        <h6 class="mb-1">
                                            Changelog
                                            <span class="text-primary ms-1">v1.3.0</span>
                                        </h6>
                                        <p class="mb-0 small">See what's new</p>
                                    </div>
                                </a>
                            </div>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
