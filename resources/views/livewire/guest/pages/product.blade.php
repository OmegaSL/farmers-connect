@extends('livewire.guest.layouts.master')

@section('title', 'Product Page')

@section('content')

    <section class="mt-8">
        <div class="container">
            @livewire('guest.component.product-overview-component', ['type' => 'product_page', 'product_slug' => $slug])
        </div>
    </section>

    <section class="mt-lg-14 mt-8">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills nav-lb-tab" id="myTab" role="tablist">
                        <!-- nav item -->
                        <li class="nav-item" role="presentation">
                            <!-- btn -->
                            <button class="nav-link active" id="product-tab" data-bs-toggle="tab"
                                data-bs-target="#product-tab-pane" type="button" role="tab"
                                aria-controls="product-tab-pane" aria-selected="true">
                                Product Details
                            </button>
                        </li>
                        <!-- nav item -->
                        <li class="nav-item" role="presentation">
                            <!-- btn -->
                            <button class="nav-link" id="details-tab" data-bs-toggle="tab"
                                data-bs-target="#details-tab-pane" type="button" role="tab"
                                aria-controls="details-tab-pane" aria-selected="false">
                                Store Information
                            </button>
                        </li>
                        <!-- nav item -->
                        {{-- <li class="nav-item" role="presentation">
                            <!-- btn -->
                            <button class="nav-link" id="reviews-tab" data-bs-toggle="tab"
                                data-bs-target="#reviews-tab-pane" type="button" role="tab"
                                aria-controls="reviews-tab-pane" aria-selected="false">
                                Reviews
                            </button>
                        </li> --}}
                        {{-- <!-- nav item -->
                        <li class="nav-item" role="presentation">
                            <!-- btn -->
                            <button class="nav-link" id="sellerInfo-tab" data-bs-toggle="tab"
                                data-bs-target="#sellerInfo-tab-pane" type="button" role="tab"
                                aria-controls="sellerInfo-tab-pane" aria-selected="false" disabled>
                                Seller Info
                            </button>
                        </li> --}}
                    </ul>
                    <!-- tab content -->
                    <div class="tab-content" id="myTabContent">
                        <!-- tab pane -->
                        <div class="tab-pane fade show active" id="product-tab-pane" role="tabpanel"
                            aria-labelledby="product-tab" tabindex="0">
                            <div class="my-8">
                                <div class="mb-5">
                                    <!-- text -->
                                    {!! $product->long_description !!}
                                </div>
                            </div>
                        </div>
                        <!-- tab pane -->
                        <div class="tab-pane fade" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab"
                            tabindex="0">
                            <div class="my-8">
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="mb-4">Details</h4>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <table class="table table-striped">
                                            <!-- table -->
                                            <tbody>
                                                <tr>
                                                    <th>Store Name</th>
                                                    <td>{{ $product->store->store_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Region</th>
                                                    <td>
                                                        {{ $product->store?->town?->district?->region?->name ?? 'N/A' }}
                                                        Region
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>District</th>
                                                    <td>{{ $product->store?->town?->district?->name ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Town</th>
                                                    <td>{{ $product->store?->town?->name ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Address</th>
                                                    <td>{{ $product->store?->address }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <table class="table table-striped">
                                            <!-- table -->
                                            <tbody>
                                                <tr>
                                                    <th colspan="2" class="text-center">Store Description</th>
                                                    {{-- <td>SB0025UJ75W</td> --}}
                                                </tr>
                                                <tr>
                                                    <th colspan="2" class="text-center">
                                                        {{ $product->store->description }}
                                                    </th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- tab pane -->
                        <div class="tab-pane fade" id="reviews-tab-pane" role="tabpanel" aria-labelledby="reviews-tab"
                            tabindex="0">
                            <div class="my-8">
                                <!-- row -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="me-lg-12 mb-6 mb-md-0">
                                            <div class="mb-5">
                                                <!-- title -->
                                                <h4 class="mb-3">Customer reviews</h4>
                                                <span>
                                                    <!-- rating -->
                                                    <small class="text-warning">
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-half"></i>
                                                    </small>
                                                    <span class="ms-3">4.1 out of 5</span>
                                                    <small class="ms-3">11,130 global ratings</small>
                                                </span>
                                            </div>
                                            <div class="mb-8">
                                                <!-- progress -->
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="text-nowrap me-3 text-muted">
                                                        <span class="d-inline-block align-middle text-muted">5</span>
                                                        <i class="bi bi-star-fill ms-1 small text-warning"></i>
                                                    </div>
                                                    <div class="w-100">
                                                        <div class="progress" style="height: 6px">
                                                            <div class="progress-bar bg-warning" role="progressbar"
                                                                style="width: 60%" aria-valuenow="60" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <span class="text-muted ms-3">53%</span>
                                                </div>
                                                <!-- progress -->
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="text-nowrap me-3 text-muted">
                                                        <span class="d-inline-block align-middle text-muted">4</span>
                                                        <i class="bi bi-star-fill ms-1 small text-warning"></i>
                                                    </div>
                                                    <div class="w-100">
                                                        <div class="progress" style="height: 6px">
                                                            <div class="progress-bar bg-warning" role="progressbar"
                                                                style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                                aria-valuemax="50"></div>
                                                        </div>
                                                    </div>
                                                    <span class="text-muted ms-3">22%</span>
                                                </div>
                                                <!-- progress -->
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="text-nowrap me-3 text-muted">
                                                        <span class="d-inline-block align-middle text-muted">3</span>
                                                        <i class="bi bi-star-fill ms-1 small text-warning"></i>
                                                    </div>
                                                    <div class="w-100">
                                                        <div class="progress" style="height: 6px">
                                                            <div class="progress-bar bg-warning" role="progressbar"
                                                                style="width: 35%" aria-valuenow="35" aria-valuemin="0"
                                                                aria-valuemax="35"></div>
                                                        </div>
                                                    </div>
                                                    <span class="text-muted ms-3">14%</span>
                                                </div>
                                                <!-- progress -->
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="text-nowrap me-3 text-muted">
                                                        <span class="d-inline-block align-middle text-muted">2</span>
                                                        <i class="bi bi-star-fill ms-1 small text-warning"></i>
                                                    </div>
                                                    <div class="w-100">
                                                        <div class="progress" style="height: 6px">
                                                            <div class="progress-bar bg-warning" role="progressbar"
                                                                style="width: 22%" aria-valuenow="22" aria-valuemin="0"
                                                                aria-valuemax="22"></div>
                                                        </div>
                                                    </div>
                                                    <span class="text-muted ms-3">5%</span>
                                                </div>
                                                <!-- progress -->
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="text-nowrap me-3 text-muted">
                                                        <span class="d-inline-block align-middle text-muted">1</span>
                                                        <i class="bi bi-star-fill ms-1 small text-warning"></i>
                                                    </div>
                                                    <div class="w-100">
                                                        <div class="progress" style="height: 6px">
                                                            <div class="progress-bar bg-warning" role="progressbar"
                                                                style="width: 14%" aria-valuenow="14" aria-valuemin="0"
                                                                aria-valuemax="14"></div>
                                                        </div>
                                                    </div>
                                                    <span class="text-muted ms-3">7%</span>
                                                </div>
                                            </div>
                                            <div class="d-grid">
                                                <h4>Review this product</h4>
                                                <p class="mb-0">Share your thoughts with other customers.</p>
                                                <a href="#" class="btn btn-outline-gray-400 mt-4 text-muted">Write
                                                    the Review</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- col -->
                                    <div class="col-md-8">
                                        <div class="mb-10">
                                            <div class="d-flex justify-content-between align-items-center mb-8">
                                                <div>
                                                    <!-- heading -->
                                                    <h4>Reviews</h4>
                                                </div>
                                                <div>
                                                    <select class="form-select">
                                                        <option selected>Top Reviews</option>
                                                        <option value="Most Recent">Most Recent</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="d-flex border-bottom pb-6 mb-6">
                                                <!-- img -->
                                                <!-- img -->
                                                <img src="../assets/images/avatar/avatar-10.jpg" alt=""
                                                    class="rounded-circle avatar-lg" />
                                                <div class="ms-5">
                                                    <h6 class="mb-1">Shankar Subbaraman</h6>
                                                    <!-- select option -->
                                                    <!-- content -->
                                                    <p class="small">
                                                        <span class="text-muted">30 December 2022</span>
                                                        <span class="text-primary ms-3 fw-bold">Verified Purchase</span>
                                                    </p>
                                                    <!-- rating -->
                                                    <div class="mb-2">
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <span class="ms-3 text-dark fw-bold">Need to recheck the weight at
                                                            delivery
                                                            point</span>
                                                    </div>
                                                    <!-- text-->
                                                    <p>
                                                        Product quality is good. But, weight seemed less than 1kg. Since it
                                                        is
                                                        being sent in open package, there is a possibility of pilferage in
                                                        between.
                                                        FreshCart sends the veggies and fruits through sealed plastic covers
                                                        and
                                                        Barcode on the weight etc. .
                                                    </p>
                                                    <div>
                                                        <div class="border icon-shape icon-lg border-2">
                                                            <!-- img -->
                                                            <img src="../assets/images/products/product-img-1.jpg"
                                                                alt="" class="img-fluid" />
                                                        </div>
                                                        <div class="border icon-shape icon-lg border-2 ms-1">
                                                            <!-- img -->
                                                            <img src="../assets/images/products/product-img-2.jpg"
                                                                alt="" class="img-fluid" />
                                                        </div>
                                                        <div class="border icon-shape icon-lg border-2 ms-1">
                                                            <!-- img -->
                                                            <img src="../assets/images/products/product-img-3.jpg"
                                                                alt="" class="img-fluid" />
                                                        </div>
                                                    </div>
                                                    <!-- icon -->
                                                    <div class="d-flex justify-content-end mt-4">
                                                        <a href="#" class="text-muted">
                                                            <i class="feather-icon icon-thumbs-up me-1"></i>
                                                            Helpful
                                                        </a>
                                                        <a href="#" class="text-muted ms-4">
                                                            <i class="feather-icon icon-flag me-2"></i>
                                                            Report abuse
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex border-bottom pb-6 mb-6 pt-4">
                                                <!-- img -->
                                                <img src="../assets/images/avatar/avatar-12.jpg" alt=""
                                                    class="rounded-circle avatar-lg" />
                                                <div class="ms-5">
                                                    <h6 class="mb-1">Robert Thomas</h6>
                                                    <!-- content -->
                                                    <p class="small">
                                                        <span class="text-muted">29 December 2022</span>
                                                        <span class="text-primary ms-3 fw-bold">Verified Purchase</span>
                                                    </p>
                                                    <!-- rating -->
                                                    <div class="mb-2">
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star text-warning"></i>
                                                        <span class="ms-3 text-dark fw-bold">Need to recheck the weight at
                                                            delivery
                                                            point</span>
                                                    </div>

                                                    <p>
                                                        Product quality is good. But, weight seemed less than 1kg. Since it
                                                        is
                                                        being sent in open package, there is a possibility of pilferage in
                                                        between.
                                                        FreshCart sends the veggies and fruits through sealed plastic covers
                                                        and
                                                        Barcode on the weight etc. .
                                                    </p>

                                                    <!-- icon -->
                                                    <div class="d-flex justify-content-end mt-4">
                                                        <a href="#" class="text-muted">
                                                            <i class="feather-icon icon-thumbs-up me-1"></i>
                                                            Helpful
                                                        </a>
                                                        <a href="#" class="text-muted ms-4">
                                                            <i class="feather-icon icon-flag me-2"></i>
                                                            Report abuse
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex border-bottom pb-6 mb-6 pt-4">
                                                <!-- img -->
                                                <img src="../assets/images/avatar/avatar-9.jpg" alt=""
                                                    class="rounded-circle avatar-lg" />
                                                <div class="ms-5">
                                                    <h6 class="mb-1">Barbara Tay</h6>
                                                    <!-- content -->
                                                    <p class="small">
                                                        <span class="text-muted">28 December 2022</span>
                                                        <span class="text-danger ms-3 fw-bold">Unverified Purchase</span>
                                                    </p>
                                                    <!-- rating -->
                                                    <div class="mb-2">
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star text-warning"></i>
                                                        <span class="ms-3 text-dark fw-bold">Need to recheck the weight at
                                                            delivery
                                                            point</span>
                                                    </div>

                                                    <p>Everytime i ordered from fresh i got greenish yellow bananas just
                                                        like i
                                                        wanted so go for it , its happens very rare that u get over riped
                                                        ones.</p>

                                                    <!-- icon -->
                                                    <div class="d-flex justify-content-end mt-4">
                                                        <a href="#" class="text-muted">
                                                            <i class="feather-icon icon-thumbs-up me-1"></i>
                                                            Helpful
                                                        </a>
                                                        <a href="#" class="text-muted ms-4">
                                                            <i class="feather-icon icon-flag me-2"></i>
                                                            Report abuse
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex border-bottom pb-6 mb-6 pt-4">
                                                <!-- img -->
                                                <img src="../assets/images/avatar/avatar-8.jpg" alt=""
                                                    class="rounded-circle avatar-lg" />
                                                <div class="ms-5 flex-grow-1">
                                                    <h6 class="mb-1">Sandra Langevin</h6>
                                                    <!-- content -->
                                                    <p class="small">
                                                        <span class="text-muted">8 December 2022</span>
                                                        <span class="text-danger ms-3 fw-bold">Unverified Purchase</span>
                                                    </p>
                                                    <!-- rating -->
                                                    <div class="mb-2">
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star text-warning"></i>
                                                        <span class="ms-3 text-dark fw-bold">Great product</span>
                                                    </div>

                                                    <p>Great product & package. Delivery can be expedited.</p>

                                                    <!-- icon -->
                                                    <div class="d-flex justify-content-end mt-4">
                                                        <a href="#" class="text-muted">
                                                            <i class="feather-icon icon-thumbs-up me-1"></i>
                                                            Helpful
                                                        </a>
                                                        <a href="#" class="text-muted ms-4">
                                                            <i class="feather-icon icon-flag me-2"></i>
                                                            Report abuse
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <a href="#" class="btn btn-outline-gray-400 text-muted">Read More
                                                    Reviews</a>
                                            </div>
                                        </div>
                                        <div>
                                            <!-- rating -->
                                            <h3 class="mb-5">Create Review</h3>
                                            <div class="border-bottom py-4 mb-4">
                                                <h4 class="mb-3">Overall rating</h4>
                                                <div class="rater"></div>
                                            </div>
                                            <div class="border-bottom py-4 mb-4">
                                                <h4 class="mb-0">Rate Features</h4>
                                                <div class="my-5">
                                                    <h5>Flavor</h5>
                                                    <div class="rater"></div>
                                                </div>
                                                <div class="my-5">
                                                    <h5>Value for money</h5>
                                                    <div class="rater"></div>
                                                </div>
                                                <div class="my-5">
                                                    <h5>Scent</h5>
                                                    <div class="rater"></div>
                                                </div>
                                            </div>
                                            <!-- form control -->
                                            <div class="border-bottom py-4 mb-4">
                                                <h5>Add a headline</h5>
                                                <input type="text" class="form-control"
                                                    placeholder="What’s most important to know" />
                                            </div>
                                            <div class="border-bottom py-4 mb-4">
                                                <h5>Add a photo or video</h5>
                                                <p>Shoppers find images and videos more helpful than text alone.</p>

                                                <div id="my-dropzone"
                                                    class="dropzone mt-4 border-dashed rounded-2 min-h-0">
                                                </div>
                                            </div>
                                            <div class="py-4 mb-4">
                                                <!-- heading -->
                                                <h5>Add a written review</h5>
                                                <textarea class="form-control" rows="3"
                                                    placeholder="What did you like or dislike? What did you use this product for?"></textarea>
                                            </div>
                                            <!-- button -->
                                            <div class="d-flex justify-content-end">
                                                <a href="#" class="btn btn-primary">Submit Review</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- tab pane -->
                        <div class="tab-pane fade" id="sellerInfo-tab-pane" role="tabpanel"
                            aria-labelledby="sellerInfo-tab" tabindex="0">...</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if ($related_products->count() > 0)
        <!-- section -->
        <section class="my-lg-14 my-14">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <!-- heading -->
                        <h3>Related Items</h3>
                    </div>
                </div>
                <!-- row -->
                <div class="row g-4 row-cols-lg-5 row-cols-2 row-cols-md-2 mt-2">
                    @foreach ($related_products as $related_product)
                        @livewire('guest.component.product-card-component', ['product' => $related_product])
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection
