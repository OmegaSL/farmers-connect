@extends('livewire.guest.layouts.master')

@section('title', 'Home Page')

@section('content')

    <!-- section -->
    <section class="mt-8">
        <!-- contianer -->
        <div class="container">
            <div class="row">
                <!-- col -->
                <div class="col-12">
                    <!-- cta -->
                    <div
                        class="bg-light d-lg-flex justify-content-between align-items-center py-6 py-lg-3 px-8 text-center text-lg-start rounded">
                        <!-- img -->
                        <div class="d-lg-flex align-items-center">
                            <img src="{{ asset('assets/images/about/about-icons-1.svg') }}" alt="" class="img-fluid" />
                            <!-- text -->

                            <div class="ms-lg-4">
                                <h1 class="fs-2 mb-1">Welcome to {{ config('app.name') }}</h1>
                                <span>
                                    Thank you for choosing {{ config('app.name') }}. Get a variety of fresh and healthy
                                    products from us.
                                </span>
                            </div>
                        </div>
                        {{-- <div class="mt-3 mt-lg-0">
                        <!-- btn -->
                        <a href="#" class="btn btn-dark">Download FreshCart App</a>
                    </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section -->
    {{-- <section class="mt-8">
        <div class="container">
            <!-- row -->
            <div class="table-responsive-xl pb-6 pb-xl-0">
                <div class="row flex-nowrap">
                    <div class="col-12 col-xl-4 col-lg-6">
                        <div class="p-8 mb-3 rounded"
                            style="background: url({{ asset('assets/images/banner/ad-banner-1.jpg') }}) no-repeat; background-size: cover">
                            <div>
                                <h3 class="mb-0 fw-bold">
                                    10% cashback on
                                    <br />
                                    personal care
                                </h3>
                                <div class="mt-4 mb-5 fs-5">
                                    <p class="mb-0">Max cashback: $12</p>
                                    <span>
                                        Code:
                                        <span class="fw-bold text-dark">CARE12</span>
                                    </span>
                                </div>
                                <a href="#" class="btn btn-dark">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-4 col-lg-6">
                        <div class="p-8 mb-3 rounded"
                            style="background: url(../assets/images/banner/ad-banner-2.jpg) no-repeat; background-size: cover">
                            <!-- Banner Content -->
                            <div>
                                <!-- Banner Content -->
                                <h3 class="fw-bold mb-3">
                                    Say yes to
                                    <br />
                                    season’s fresh
                                </h3>
                                <div class="mt-4 mb-5 fs-5">
                                    <p class="fs-5 mb-0">
                                        Refresh your day
                                        <br />
                                        the fruity way
                                    </p>
                                </div>

                                <a href="#" class="btn btn-dark">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-4 col-lg-6">
                        <div class="p-8 mb-3 rounded"
                            style="background: url(../assets/images/banner/ad-banner-3.jpg) no-repeat; background-size: cover">
                            <div>
                                <!-- Banner Content -->
                                <h3 class="fw-bold mb-3">
                                    When in doubt,
                                    <br />
                                    eat ice cream
                                </h3>
                                <div class="mt-4 mb-5 fs-5">
                                    <p class="fs-5 mb-0">
                                        Enjoy a scoop of
                                        <br />
                                        summer today
                                    </p>
                                </div>

                                <a href="#" class="btn btn-dark">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- section -->
    <section class="my-lg-14 my-8">
        <!-- category -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-12">
                    <div class="mb-8">
                        <!-- heading -->
                        <h3 class="mb-0">Shop by Category</h3>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-6 g-6">
                @foreach ($product_categories->take(12) as $product_category)
                    <!-- col -->
                    <div class="col">
                        <a href="{{ route('shop.page.with.category', $product_category->slug) }}"
                            class="text-decoration-none text-inherit">
                            <!-- card -->
                            @php
                                $categoryHasImage = \Illuminate\Support\Facades\DB::table('product_categories')
                                    ->where('id', $product_category->id)
                                    ->first()->image;
                            @endphp
                            <div class="card card-product">
                                <div class="card-body text-center py-8">
                                    <!-- img -->
                                    <img src="{{ $product_category->image }}"
                                        style="{{ $categoryHasImage == null ? 'filter: blur(5px);' : '' }}"
                                        alt="Grocery Ecommerce Template" class="mb-3 resizable-image" width="120" />
                                    <!-- text -->
                                    <div class="text-truncate">{{ $product_category->name }}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @foreach ($product_categories->take(3) as $product_category)
        @livewire('guest.component.product-slider-component', ['product_category' => $product_category], key($product_category->id))
    @endforeach

    <!-- cta section -->
    {{-- <section>
        <div class="container">
            <hr class="my-lg-14 my-8" />
            <!-- row -->
            <div class="row align-items-center">
                <div class="offset-lg-2 col-lg-4 col-md-6">
                    <div class="text-center">
                        <!-- img -->
                        <img src="../assets/images/png/iphone-2.png" alt="" class="img-fluid" />
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="mb-6">
                        <div class="mb-7">
                            <!-- heading -->
                            <h2>Get the FreshCart app</h2>
                            <p class="mb-0">We will send you a link, open it on your phone to download the app.</p>
                        </div>
                        <div class="mb-5">
                            <!-- form check -->
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="flexRadioDefault1" />
                                <label class="form-check-label" for="flexRadioDefault1">Email</label>
                            </div>
                            <!-- form check -->
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="flexRadioDefault2" checked />
                                <label class="form-check-label" for="flexRadioDefault2">Phone</label>
                            </div>
                            <!-- form -->
                            <form class="row g-3 mt-1">
                                <!-- col -->
                                <div class="col-lg-6 col-7">
                                    <!-- input -->
                                    <input type="text" class="form-control" placeholder="Phone" />
                                </div>
                                <!-- col -->
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-3">Share app link</button>
                                </div>
                            </form>
                        </div>
                        <div>
                            <!-- app -->
                            <small>Download app from</small>
                            <ul class="list-inline mb-0 mt-3">
                                <!-- list item -->
                                <li class="list-inline-item">
                                    <!-- img -->
                                    <a href="#!"><img src="../assets/images/appbutton/appstore-btn.svg"
                                            alt="" style="width: 140px" /></a>
                                </li>
                                <li class="list-inline-item">
                                    <!-- img -->
                                    <a href="#!"><img src="../assets/images/appbutton/googleplay-btn.svg"
                                            alt="" style="width: 140px" /></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-lg-14 my-8" />
        </div>
    </section> --}}
    <!-- featured section -->
    <section class="my-lg-14 my-8">
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="mb-8 mb-lg-0">
                        <!-- img -->
                        <div class="mb-6"><img src="{{ asset('assets/images/icons/clock.svg') }}" alt="" />
                        </div>
                        <!-- title -->
                        <h3 class="h5 mb-3">10 minute grocery now</h3>
                        <!-- text -->
                        <p class="mb-0">Get your order delivered to your doorstep at the earliest from FreshCart
                            pickup stores near you.</p>
                    </div>
                </div>
                <!-- col -->
                <div class="col-md-6 col-lg-3">
                    <div class="mb-8 mb-lg-0">
                        <!-- img -->
                        <div class="mb-6"><img src="{{ asset('assets/images/icons/gift.svg') }}" alt="" />
                        </div>
                        <!-- title -->
                        <h3 class="h5 mb-3">Best Prices & Offers</h3>
                        <!-- text -->
                        <p class="mb-0">Cheaper prices than your local supermarket, great cashback offers to top it
                            off. Get best pricess & offers.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="mb-8 mb-lg-0">
                        <!-- img -->
                        <div class="mb-6"><img src="{{ asset('assets/images/icons/package.svg') }}" alt="" />
                        </div>
                        <!-- title -->
                        <h3 class="h5 mb-3">Wide Assortment</h3>
                        <!-- text -->
                        <p class="mb-0">Choose from 5000+ products across food, personal care, household, bakery,
                            veg and non-veg & other categories.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="mb-8 mb-lg-0">
                        <!-- img -->
                        <div class="mb-6"><img src="{{ asset('assets/images/icons/refresh-cw.svg') }}" alt="" />
                        </div>
                        <!-- title -->
                        <h3 class="h5 mb-3">Easy Returns</h3>
                        <!-- text -->
                        <p class="mb-0">
                            Not satisfied with a product? Return it at the doorstep & get a refund within hours. No
                            questions asked
                            <a href="#!">policy</a>
                            .
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
