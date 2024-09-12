<div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="quickViewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-8">
                    <div class="position-absolute top-0 end-0 me-3 mt-3">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            wire:click='resetFields'></button>
                    </div>
                    <div class="row">
                        @if ($this->product_id)
                            <div class="col-lg-6">
                                <!-- img slide -->
                                <div class="product productModal" id="productModal">
                                    <div class="zoom" onmousemove="zoom(event)"
                                        style="background-image: url({{ $product->image }})">
                                        <!-- img -->
                                        <img src="{{ $product->image }}" alt="" />
                                    </div>
                                    @foreach ($product->product_images as $image)
                                        <div class="zoom" onmousemove="zoom(event)"
                                            style="background-image: url({{ $image->image }})">
                                            <!-- img -->
                                            <img src="{{ $image->image }}" alt="" />
                                        </div>
                                    @endforeach
                                </div>
                                <!-- product tools -->
                                <div class="product-tools">
                                    <div class="thumbnails row g-3" id="productModalThumbnails">
                                        <div class="col-3" class="tns-nav-active">
                                            <div class="thumbnails-img">
                                                <!-- img -->
                                                <img src="{{ $product->image }}" alt="" />
                                            </div>
                                        </div>
                                        @foreach ($product->product_images as $image)
                                            <div class="col-3">
                                                <div class="thumbnails-img">
                                                    <!-- img -->
                                                    <img src="{{ $image->image }}" alt="" />
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="ps-lg-8 mt-6 mt-lg-0">
                                    <a href="#!"
                                        class="mb-4 d-block">{{ $product->product_category?->name ?? 'N/A' }}</a>
                                    <h2 class="mb-1 h1">{{ $product->name }}</h2>
                                    <div class="mb-4">
                                        {!! \App\Helpers\GlobalHelper::displayReviewStarsForSingleItemPage(
                                            $product->reviews->count('rating'),
                                            $product->reviews->count(),
                                        ) !!}
                                    </div>
                                    <div class="fs-4">
                                        {{-- <span class="fw-bold text-dark">$32</span>
                                        <span class="text-decoration-line-through text-muted">$35</span>
                                        <span><small class="fs-6 ms-2 text-danger">26% Off</small></span> --}}
                                        @if ($product->sale_price != null || $product->sale_price > 0)
                                            <span class="fw-bold text-dark">&#8373; {{ $product->sale_price }}</span>
                                            <span class="text-decoration-line-through text-muted">
                                                &#8373; {{ $price }}
                                            </span>
                                            <span>
                                                <small class="fs-6 ms-2 text-danger">
                                                    {{ \App\Helpers\GlobalHelper::percentageOff($price, $product->sale_price) }}
                                                </small>
                                            </span>
                                        @else
                                            <span class="fw-bold text-dark">&#8373; {{ $price }}</span>
                                        @endif
                                    </div>
                                    <hr class="my-6" />
                                    <div class="mb-4">
                                        @foreach ($product->variants as $variant)
                                            <button type="button" wire:click='selectVariant({{ $variant->id }})'
                                                class="btn btn-secondary {{ $this->selectedVariant == $variant->id ? 'active disabled' : '' }}">
                                                {{ $variant->variant_name }}
                                            </button>
                                        @endforeach
                                        {{-- <button type="button" class="btn btn-outline-secondary">500g</button>
                                        <button type="button" class="btn btn-outline-secondary">1kg</button> --}}
                                    </div>
                                    <div>
                                        <!-- input -->
                                        <!-- input -->
                                        <div class="input-group input-spinner">
                                            <button type="button" class="button-minus btn btn-sm"
                                                wire:click='decrementQuantity'>-</button>
                                            <input type="number" step="1" min="1" max="10" disabled
                                                wire:model.live='quantity' name="quantity"
                                                class="quantity-field form-control-sm form-input" />
                                            <button type="button" class="button-plus btn btn-sm"
                                                wire:click='incrementQuantity'>+</button>
                                        </div>
                                    </div>
                                    <div class="mt-3 row justify-content-start g-2 align-items-center">
                                        <div class="col-lg-4 col-md-5 col-6 d-grid">
                                            <!-- button -->
                                            <!-- btn -->
                                            @livewire('guest.component.cart-button-component', ['product' => $product, 'type' => 'single_product', 'quantity' => $this->quantity], key($product->id))
                                        </div>
                                        <div class="col-md-4 col-5">
                                            <!-- btn -->
                                            {{-- <a class="btn btn-light" href="#" data-bs-toggle="tooltip"
                                                data-bs-html="true" aria-label="Compare"><i
                                                    class="bi bi-arrow-left-right"></i></a> --}}
                                            <a class="btn btn-light" href="#!"
                                                wire:click='addToWishList({{ $product->id }})'
                                                data-bs-toggle="tooltip" data-bs-html="true" aria-label="Wishlist">
                                                <i class="feather-icon icon-heart"></i>
                                                {{-- <i
                                                    class="feather-icon {{ $product->wishlists->contains('product_id', $product->id) ? 'icon-heart' : 'icon-heart' }}"></i> --}}
                                            </a>
                                        </div>
                                    </div>
                                    <hr class="my-6" />
                                    <div>
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td>Product Code:</td>
                                                    <td>{{ $product->sku }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Availability:</td>
                                                    <td>{{ $product->available_quantity > 0 ? 'In Stock' : 'Out of Stock' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Type:</td>
                                                    <td>{{ $product->product_category?->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Shipping:</td>
                                                    <td>
                                                        <small>
                                                            Fast delivery
                                                            <span class="text-muted">( Free pickup today)</span>
                                                        </small>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @else
                            {{-- loader here --}}
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
