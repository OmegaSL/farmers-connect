<div>

    <div wire:ignore.self class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
        aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header border-bottom">
            <div class="text-start">
                <h5 id="offcanvasRightLabel" class="mb-0 fs-4">Shop Cart</h5>
                {{-- <small>Location in 382480 </small> --}}
            </div>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div>
                <!-- alert -->
                {{-- <div class="alert alert-danger p-2" role="alert">
                    You’ve got FREE delivery. Start
                    <a href="#!" class="alert-link">checkout now!</a>
                </div> --}}
                <ul class="list-group list-group-flush">
                    @forelse ($carts as $cart)
                        <!-- list group -->
                        <li class="list-group-item py-3 ps-0">
                            <!-- row -->
                            <div class="row align-items-center">
                                <div class="col-6 col-md-6 col-lg-7">
                                    <div class="d-flex">
                                        @php
                                            $hasImage = \Illuminate\Support\Facades\DB::table('products')
                                                ->where('id', $cart['attributes']['product']->id)
                                                ->first()->image;
                                        @endphp
                                        <img src="{{ $cart['attributes']['product']->image }}" alt="Ecommerce"
                                            style="{{ $hasImage == null ? 'filter: blur(5px);' : '' }}"
                                            class="icon-shape icon-xxl" />
                                        <div class="ms-3">
                                            <!-- title -->
                                            <a href="shop-single.html" class="text-inherit">
                                                <h6 class="mb-0">{{ $cart['name'] }}</h6>
                                            </a>
                                            <span><small
                                                    class="text-muted">{{ $cart['attributes']['variant']->variant_name }}</small></span>
                                            <!-- text -->
                                            <div class="mt-2 small lh-1">
                                                <a href="#!" class="text-decoration-none text-inherit">
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
                                                    <span class="text-muted"
                                                        wire:click.prevent="removeFromCart('{{ $cart['id'] }}')">Remove</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- input group -->
                                <div class="col-4 col-md-3 col-lg-3">
                                    <!-- input -->
                                    <!-- input -->
                                    <div class="input-group input-spinner">
                                        <input type="button" value="-" class="button-minus btn btn-sm"
                                            wire:click.prevent="decreaseCartQuantity('{{ $cart['id'] }}')"
                                            data-field="quantity" {{ $cart['quantity'] == 1 ? 'disabled' : '' }} />
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
                        <li class="list-group-item py-3 ps-0 border-top">
                            <div class="row align-items-center">
                                <div class="col-12 text-center">
                                    <h6 class="mb-0">Your cart is empty</h6>
                                </div>
                            </div>
                        </li>
                    @endforelse
                </ul>
                <!-- btn -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('shop.page') }}" class="btn btn-primary">Continue Shopping</a>
                    <a href="#!" wire:click.prevent="updateCart()" class="btn btn-dark">Update Cart</a>
                </div>
            </div>
        </div>
    </div>

</div>
