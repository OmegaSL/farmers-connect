@section('title', 'Cart Page')

<div>
    <!-- section -->
    <section class="mb-lg-14 mb-8 mt-8">
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-12">
                    <!-- card -->
                    <div class="card py-1 border-0 mb-8">
                        <div>
                            <h1 class="fw-bold">Shop Cart</h1>
                            <p class="mb-0">Shopping in {{ config('app.name') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-lg-8 col-md-7">
                    <div class="py-3">
                        <!-- alert -->
                        {{-- <div class="alert alert-danger p-2" role="alert">
                            You’ve got FREE delivery. Start
                            <a href="#!" class="alert-link">checkout now!</a>
                        </div> --}}
                        <ul class="list-group list-group-flush">
                            @forelse ($cart_list as $cart)
                                <!-- list group -->
                                <li class="list-group-item py-3 ps-0">
                                    <!-- row -->
                                    <div class="row align-items-center">
                                        <div class="col-6 col-md-6 col-lg-7">
                                            @php
                                                $hasImage = \Illuminate\Support\Facades\DB::table('products')
                                                    ->where('id', $cart['attributes']['product']->id)
                                                    ->first()->image;
                                            @endphp
                                            <div class="d-flex">
                                                <img src="{{ $cart['attributes']['product']->image }}"
                                                    alt="{{ $cart['name'] }}" class="icon-shape icon-xxl" />
                                                <div class="ms-3">
                                                    <!-- title -->
                                                    <a href="shop-single.html" class="text-inherit">
                                                        <h6 class="mb-0">{{ $cart['name'] }}</h6>
                                                    </a>
                                                    <span>
                                                        <small class="text-muted">
                                                            {{ $cart['attributes']['variant']?->variant_name ?? '' }}
                                                        </small>
                                                    </span>
                                                    <!-- text -->
                                                    <div class="mt-2 small lh-1">
                                                        <a href="#!"
                                                            wire:click.prevent="removeFromCart('{{ $cart['id'] }}')"
                                                            class="text-decoration-none text-inherit">
                                                            <span class="me-1 align-text-bottom">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                    height="14" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-trash-2 text-success">
                                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                                    <path
                                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                    </path>
                                                                    <line x1="10" y1="11" x2="10"
                                                                        y2="17"></line>
                                                                    <line x1="14" y1="11" x2="14"
                                                                        y2="17"></line>
                                                                </svg>
                                                            </span>
                                                            <span class="text-muted">Remove</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- input group -->
                                        <div class="col-4 col-md-4 col-lg-3">
                                            <!-- input -->
                                            <!-- input -->
                                            <div class="input-group input-spinner">
                                                <input type="button" value="-" class="button-minus btn btn-sm"
                                                    wire:click.prevent="decreaseCartQuantity('{{ $cart['id'] }}')"
                                                    data-field="quantity"
                                                    {{ $cart['quantity'] == 1 ? 'disabled' : '' }} />
                                                <input type="number" step="1" min="1" disabled
                                                    value="{{ $cart['quantity'] }}" name="quantity"
                                                    class="quantity-field form-control-sm form-input" />
                                                <input type="button" value="+" class="button-plus btn btn-sm"
                                                    wire:click.prevent="increaseCartQuantity('{{ $cart['id'] }}')"
                                                    data-field="quantity" />
                                            </div>
                                        </div>
                                        <!-- price -->
                                        <div class="col-2 text-lg-end text-start text-md-end col-md-2">
                                            @if ($cart['attributes']['product']->sale_price != null || $cart['attributes']['product']->sale_price > 0)
                                                <span class="fw-bold">&#8373;
                                                    {{ $cart['attributes']['product']->sale_price }}</span>
                                                <div class="text-decoration-line-through text-muted small">&#8373;
                                                    {{ $cart['attributes']['product']->base_price }}</div>
                                            @else
                                                <span class="fw-bold">&#8373;
                                                    {{ $cart['attributes']['product']->base_price }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="list-group-item py-3 ps-0">
                                    <div class="alert alert-danger p-2" role="alert">
                                        No items in your cart. Go
                                        <a href="{{ route('shop.page') }}" class="alert-link">Shopping now</a>
                                    </div>
                                    {{-- <h6 class="mb-0">No items in your cart</h6>
                                    <p class="mb-0">Start shopping to fill your cart</p> --}}
                                </li>
                            @endforelse
                        </ul>
                        <!-- btn -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('shop.page') }}" class="btn btn-primary">Continue Shopping</a>
                            <a href="#!" wire:click="updateCart" class="btn btn-dark">Update Cart</a>
                        </div>
                    </div>
                </div>

                <!-- sidebar -->
                <div class="col-12 col-lg-4 col-md-5">
                    <!-- card -->
                    <div class="mb-5 card mt-6">
                        <div class="card-body p-6">
                            <!-- heading -->
                            <h2 class="h5 mb-4">Summary</h2>
                            <div class="card mb-2">
                                <!-- list group -->
                                <ul class="list-group list-group-flush">
                                    <!-- list group item -->
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="me-auto">
                                            <div>Item Subtotal</div>
                                        </div>
                                        <span>
                                            &#8373; {{ $this->sub_total }}
                                        </span>
                                    </li>

                                    <!-- list group item -->
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="me-auto">
                                            <div>Service Fee</div>
                                        </div>
                                        <span>&#8373; {{ $this->service_fee }}</span>
                                    </li>
                                    <!-- list group item -->
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="me-auto">
                                            <div class="fw-bold">Subtotal</div>
                                        </div>
                                        <span class="fw-bold">&#8373; {{ $this->total }}</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="d-grid mb-1 mt-4">
                                <!-- btn -->
                                <a href="{{ route('checkout.page') }}"
                                    class="btn btn-primary btn-lg d-flex justify-content-between align-items-center"
                                    type="submit">
                                    Go to Checkout
                                    <span class="fw-bold">&#8373; {{ $this->total }}</span>
                                </a>
                            </div>
                            <!-- text -->
                            {{-- <p>
                                <small>
                                    By placing your order, you agree to be bound by the Freshcart
                                    <a href="#!">Terms of Service</a>
                                    and
                                    <a href="#!">Privacy Policy.</a>
                                </small>
                            </p> --}}

                            <!-- heading -->
                            <div class="mt-8">
                                <h2 class="h5 mb-3">Add Promo or Gift Card</h2>
                                <form wire:submit.prevent='redeemCode'>
                                    <div class="mb-2">
                                        <!-- input -->
                                        <label for="coupon_code" class="form-label sr-only">Coupon Code</label>
                                        <input type="text" class="form-control" id="coupon_code"
                                            wire:model='coupon_code' placeholder="Promo or Gift Card" />

                                        @error('coupon_code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- btn -->
                                    <div class="d-grid"><button type="submit"
                                            class="btn btn-outline-dark mb-1">Redeem</button></div>
                                    <p class="text-muted mb-0"><small>Terms & Conditions apply</small></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
