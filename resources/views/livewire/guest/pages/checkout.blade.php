@section('title', 'Checkout Page')

<div>

    <!-- section -->
    <section class="mb-lg-14 mb-8 mt-8">
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- col -->
                <div class="col-12">
                    <div>
                        <div class="mb-8">
                            <!-- text -->
                            <h1 class="fw-bold mb-0">Checkout</h1>
                            {{-- <p class="mb-0">
                                Already have an account? Click here to
                                <a href="#!">Sign in</a>
                                .
                            </p> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-7 col-lg-6 col-md-12">
                        <!-- accordion -->
                        <div wire:ignore.self class="accordion accordion-flush" id="accordionFlushExample">
                            <!-- accordion item -->
                            <div wire:ignore.self class="accordion-item py-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <!-- heading one -->
                                    <a href="#" class="fs-5 text-inherit collapsed h4" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseOne" aria-expanded="true"
                                        aria-controls="flush-collapseOne">
                                        <i class="feather-icon icon-map-pin me-2 text-muted"></i>
                                        Delivery address
                                    </a>
                                    {{-- <!-- btn -->
                                    <a href="#" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#addAddressModal">Add a new address</a> --}}
                                    <!-- collapse -->
                                </div>
                                <div wire:ignore.self id="flush-collapseOne" class="accordion-collapse collapse show"
                                    data-bs-parent="#accordionFlushExample">
                                    <div class="mt-3">
                                        <form wire:submit.prevent='updateProfile'>
                                            <div class="row">
                                                <div class="col-6 mt-5">
                                                    <label for="first_name" class="form-label sr-only">First
                                                        Name</label>
                                                    <input type="text" class="form-control" id="first_name"
                                                        wire:model='first_name' placeholder="First Name" required />

                                                    @error('first_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6 mt-5">
                                                    <label for="last_name" class="form-label sr-only">Last Name</label>
                                                    <input type="text" class="form-control" id="last_name"
                                                        wire:model='last_name' placeholder="Last Name" required />

                                                    @error('last_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6 mt-5">
                                                    <label for="email" class="form-label sr-only">Email
                                                        Address</label>
                                                    <input type="email" class="form-control" id="email" disabled
                                                        readonly wire:model='email' placeholder="Email Address"
                                                        required />

                                                    @error('email')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6 mt-5">
                                                    <label for="telephone" class="form-label sr-only">Telephone</label>
                                                    <input type="text" class="form-control" id="telephone"
                                                        wire:model='telephone' placeholder="Telephone" required />

                                                    @error('telephone')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                {{-- <div class="col-xl-6 col-lg-12 col-md-6 col-12 mb-4">
                                                <!-- form -->
                                                <div class="card card-body p-6">
                                                    <div class="form-check mb-4">
                                                        <input class="form-check-input" type="radio"
                                                            name="flexRadioDefault" id="homeRadio" checked />
                                                        <label class="form-check-label text-dark"
                                                            for="homeRadio">Home</label>
                                                    </div>
                                                    <!-- address -->
                                                    <address>
                                                        <strong>Jitu Chauhan</strong>
                                                        <br />

                                                        4450 North Avenue Oakland,
                                                        <br />

                                                        Nebraska, United States,
                                                        <br />

                                                        <abbr title="Phone">P: 402-776-1106</abbr>
                                                    </address>
                                                    <span class="text-danger">Default address</span>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-12 col-md-6 col-12 mb-4">
                                                <!-- input -->
                                                <div class="card card-body p-6">
                                                    <div class="form-check mb-4">
                                                        <input class="form-check-input" type="radio"
                                                            name="flexRadioDefault" id="officeRadio" />
                                                        <label class="form-check-label text-dark"
                                                            for="officeRadio">Office</label>
                                                    </div>
                                                    <address>
                                                        <strong>Nitu Chauhan</strong>
                                                        <br />
                                                        3853 Coal Road,
                                                        <br />
                                                        Tannersville, Pennsylvania, 18372, USA,
                                                        <br />

                                                        <abbr title="Phone">P: 402-776-1106</abbr>
                                                    </address>
                                                </div>
                                            </div> --}}
                                            </div>

                                            <!-- btn -->
                                            <div class="d-grid mb-1 mt-4">
                                                <button type="submit" class="btn btn-outline-dark mb-1"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#flush-collapseThree">Save</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- accordion item -->
                            <div wire:ignore.self class="accordion-item py-4">
                                <a href="#" class="text-inherit h5" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseThree" aria-expanded="false"
                                    aria-controls="flush-collapseThree">
                                    <i class="feather-icon icon-shopping-bag me-2 text-muted"></i>
                                    Delivery instructions
                                    <!-- collapse -->
                                </a>
                                <div wire:ignore.self id="flush-collapseThree" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample">
                                    <div class="mt-5">
                                        <label for="DeliveryInstructions" class="form-label sr-only">Delivery
                                            instructions</label>
                                        <textarea class="form-control" id="DeliveryInstructions" rows="3" placeholder="Write delivery instructions "></textarea>
                                        <p class="form-text">Add instructions for how you want your order shopped
                                            and/or
                                            delivered</p>
                                        <div class="mt-5 d-flex justify-content-end">
                                            <a href="#" class="btn btn-outline-gray-400 text-muted"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                                aria-expanded="false" aria-controls="flush-collapseTwo">
                                                Prev
                                            </a>
                                            <a href="#" class="btn btn-primary ms-2" data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapseFour" aria-expanded="false"
                                                aria-controls="flush-collapseFour">
                                                Next
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- accordion item -->
                            <div wire:ignore.self class="accordion-item py-4">
                                <a href="#" class="text-inherit h5" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseFour" aria-expanded="false"
                                    aria-controls="flush-collapseFour">
                                    <i class="feather-icon icon-credit-card me-2 text-muted"></i>
                                    Payment Method
                                    <!-- collapse -->
                                </a>
                                <div wire:ignore.self id="flush-collapseFour" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample">
                                    <div class="mt-5">
                                        <div>
                                            {{-- <div class="card card-bordered shadow-none mb-2">
                                                <!-- card body -->
                                                <div class="card-body p-6">
                                                    <div class="d-flex">
                                                        <div class="form-check">
                                                            <!-- checkbox -->
                                                            <input class="form-check-input" type="radio"
                                                                name="flexRadioDefault" id="paypal" />
                                                            <label class="form-check-label ms-2"
                                                                for="paypal"></label>
                                                        </div>
                                                        <div>
                                                            <!-- title -->
                                                            <h5 class="mb-1 h6">Payment with Paypal</h5>
                                                            <p class="mb-0 small">You will be redirected to PayPal
                                                                website to
                                                                complete your purchase securely.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <!-- card -->
                                            {{-- <div class="card card-bordered shadow-none mb-2">
                                                <!-- card body -->
                                                <div class="card-body p-6">
                                                    <div class="d-flex mb-4">
                                                        <div class="form-check">
                                                            <!-- input -->
                                                            <input class="form-check-input" type="radio"
                                                                name="flexRadioDefault" id="creditdebitcard" />
                                                            <label class="form-check-label ms-2"
                                                                for="creditdebitcard"></label>
                                                        </div>
                                                        <div>
                                                            <h5 class="mb-1 h6">Credit / Debit Card</h5>
                                                            <p class="mb-0 small">Safe money transfer using your bank
                                                                accou k
                                                                account. We support Mastercard tercard, Visa, Discover
                                                                and Stripe.
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row g-2">
                                                        <div class="col-12">
                                                            <!-- input -->
                                                            <div class="mb-3">
                                                                <label for="card-mask" class="form-label">Card
                                                                    Number</label>
                                                                <input type="text" class="form-control"
                                                                    id="card-mask" placeholder="xxxx-xxxx-xxxx-xxxx"
                                                                    required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <!-- input -->
                                                            <div class="mb-3 mb-lg-0">
                                                                <label class="form-label" for="nameoncard">Name on
                                                                    card</label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Enter name" id="nameoncard" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-12">
                                                            <!-- input -->
                                                            <div class="mb-3 mb-lg-0 position-relative">
                                                                <label class="form-label" for="expirydate">Expiry
                                                                    date</label>
                                                                <input type="text" class="form-control"
                                                                    id="expirydate" placeholder="MM/YY" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-12">
                                                            <!-- input -->
                                                            <div class="mb-3 mb-lg-0">
                                                                <label for="digit-mask" class="form-label">
                                                                    CVV Code
                                                                    <i class="fe fe-help-circle ms-1"
                                                                        data-bs-toggle="tooltip" data-placement="top"
                                                                        title="A 3 - digit number, typically printed on the back of a card."></i>
                                                                </label>
                                                                <input type="password" class="form-control"
                                                                    name="digit-mask" id="digit-mask"
                                                                    placeholder="xxx" maxlength="3"
                                                                    inputmode="numeric" required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <!-- card -->
                                            <div class="card card-bordered shadow-none mb-2">
                                                <!-- card body -->
                                                <div class="card-body p-6">
                                                    <!-- check input -->
                                                    <div class="d-flex">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                wire:model.live='paymode' name="paymode"
                                                                value="mobilemoneygh" id="mobilemoneygh" />
                                                            <label class="form-check-label ms-2"
                                                                for="mobilemoneygh"></label>
                                                        </div>
                                                        <div>
                                                            <!-- title -->
                                                            <h5 class="mb-1 h6">Pay with Mobile Money</h5>
                                                            <p class="mb-0 small">You will be redirected to a mobile
                                                                money site to
                                                                complete your purchase securely.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- card -->
                                            <div class="card card-bordered shadow-none">
                                                <div class="card-body p-6">
                                                    <!-- check input -->
                                                    <div class="d-flex">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                wire:model.live='paymode' name="paymode"
                                                                value="cashondelivery" id="cashondelivery" />
                                                            <label class="form-check-label ms-2"
                                                                for="cashondelivery"></label>
                                                        </div>
                                                        <div>
                                                            <!-- title -->
                                                            <h5 class="mb-1 h6">Cash on Delivery</h5>
                                                            <p class="mb-0 small">Pay with cash when your order is
                                                                delivered.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Button -->
                                            <div class="mt-5 d-flex justify-content-end">
                                                <a href="#" class="btn btn-outline-gray-400 text-muted"
                                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"
                                                    aria-expanded="false" aria-controls="flush-collapseThree">
                                                    Prev
                                                </a>
                                                <a href="#" class="btn btn-primary ms-2">Place Order</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 offset-xl-1 col-xl-4 col-lg-6">
                        <div class="mt-4 mt-lg-0">
                            <div class="card shadow-sm">
                                <h5 class="px-6 py-4 bg-transparent mb-0">Order Details</h5>
                                <ul class="list-group list-group-flush">
                                    <!-- list group item -->
                                    <li class="list-group-item px-4 py-3">
                                        <div class="row align-items-center">
                                            <div class="col-2 col-md-2">
                                                <img src="../assets/images/products/product-img-1.jpg" alt="Ecommerce"
                                                    class="img-fluid" />
                                            </div>
                                            <div class="col-5 col-md-5">
                                                <h6 class="mb-0">Haldiram's Sev Bhujia</h6>
                                                <span><small class="text-muted">.98 / lb</small></span>
                                            </div>
                                            <div class="col-2 col-md-2 text-center text-muted">
                                                <span>1</span>
                                            </div>
                                            <div class="col-3 text-lg-end text-start text-md-end col-md-3">
                                                <span class="fw-bold">$5.00</span>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- list group item -->
                                    <li class="list-group-item px-4 py-3">
                                        <div class="row align-items-center">
                                            <div class="col-2 col-md-2">
                                                <img src="../assets/images/products/product-img-2.jpg" alt="Ecommerce"
                                                    class="img-fluid" />
                                            </div>
                                            <div class="col-5 col-md-5">
                                                <h6 class="mb-0">NutriChoice Digestive</h6>
                                                <span><small class="text-muted">250g</small></span>
                                            </div>
                                            <div class="col-2 col-md-2 text-center text-muted">
                                                <span>1</span>
                                            </div>
                                            <div class="col-3 text-lg-end text-start text-md-end col-md-3">
                                                <span class="fw-bold">$20.00</span>
                                                <div class="text-decoration-line-through text-muted small">$26.00</div>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- list group item -->
                                    <li class="list-group-item px-4 py-3">
                                        <div class="row align-items-center">
                                            <div class="col-2 col-md-2">
                                                <img src="../assets/images/products/product-img-3.jpg" alt="Ecommerce"
                                                    class="img-fluid" />
                                            </div>
                                            <div class="col-5 col-md-5">
                                                <h6 class="mb-0">Cadbury 5 Star Chocolate</h6>
                                                <span><small class="text-muted">1 kg</small></span>
                                            </div>
                                            <div class="col-2 col-md-2 text-center text-muted">
                                                <span>1</span>
                                            </div>
                                            <div class="col-3 text-lg-end text-start text-md-end col-md-3">
                                                <span class="fw-bold">$15.00</span>
                                                <div class="text-decoration-line-through text-muted small">$20.00</div>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- list group item -->
                                    <li class="list-group-item px-4 py-3">
                                        <div class="row align-items-center">
                                            <div class="col-2 col-md-2">
                                                <img src="../assets/images/products/product-img-4.jpg" alt="Ecommerce"
                                                    class="img-fluid" />
                                            </div>
                                            <div class="col-5 col-md-5">
                                                <h6 class="mb-0">Onion Flavour Potato</h6>
                                                <span><small class="text-muted">250g</small></span>
                                            </div>
                                            <div class="col-2 col-md-2 text-center text-muted">
                                                <span>1</span>
                                            </div>
                                            <div class="col-3 text-lg-end text-start text-md-end col-md-3">
                                                <span class="fw-bold">$15.00</span>
                                                <div class="text-decoration-line-through text-muted small">$20.00</div>
                                            </div>
                                        </div>
                                    </li>

                                    <!-- list group item -->
                                    <li class="list-group-item px-4 py-3">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <div>Item Subtotal</div>
                                            <div class="fw-bold">$70.00</div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                Service Fee
                                                <i class="feather-icon icon-info text-muted" data-bs-toggle="tooltip"
                                                    title="Default tooltip"></i>
                                            </div>
                                            <div class="fw-bold">$3.00</div>
                                        </div>
                                    </li>
                                    <!-- list group item -->
                                    <li class="list-group-item px-4 py-3">
                                        <div class="d-flex align-items-center justify-content-between fw-bold">
                                            <div>Subtotal</div>
                                            <div>$73.00</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
