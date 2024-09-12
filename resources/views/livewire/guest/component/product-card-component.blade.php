<div>

    <!-- col -->
    <div class="col">
        <div class="card card-product">
            <div class="card-body">
                <!-- badge -->

                <div class="text-center position-relative">
                    <div class="position-absolute top-0 start-0">
                        @if ($product->sale_price != null || $product->sale_price > 0)
                            <span class="badge bg-danger">Sale</span>
                        @endif
                    </div>
                    <!-- img -->
                    @php
                        $hasImage = \Illuminate\Support\Facades\DB::table('products')
                            ->where('id', $product->id)
                            ->first()->image;
                    @endphp
                    {{-- <a href="#!"><img src="{{ $product->image }}" alt="Grocery Ecommerce Template"
                        class="mb-3 img-fluid" /></a> --}}
                    <a href="{{ route('product.page', $product->slug) }}">
                        <img src="{{ $product->image }}" alt="Grocery Ecommerce Template" class="mb-3 img-fluid"
                            style="{{ $hasImage == null ? 'filter: blur(5px);' : '' }}" />
                    </a>
                    <!-- action btn -->
                    <div class="card-product-action">
                        <a href="#!" wire:click='quickView({{ $product->id }})' class="btn-action"
                            data-bs-toggle="modal" data-bs-target="#quickViewModal">
                            <i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true" title="Quick View"></i>
                        </a>
                        <a href="#!" wire:click='addToWishList({{ $product->id }})' class="btn-action"
                            data-bs-toggle="tooltip" data-bs-html="true" title="Wishlist"><i
                                class="bi bi-heart"></i></a>
                        {{-- <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true"
                            title="Compare"><i class="bi bi-arrow-left-right"></i></a> --}}
                    </div>
                </div>
                <!-- heading -->
                <div class="text-small mb-1">
                    <a href="{{ route('product.page', $product->slug) }}" class="text-decoration-none text-muted">
                        <small>{{ $product->name }}</small></a>
                </div>
                <h2 class="fs-6">
                    <a href="{{ route('product.page', $product->slug) }}" class="text-inherit text-decoration-none">
                        {{ Str::limit($product->short_description, 30, '...') }}
                    </a>
                </h2>
                <div>
                    <!-- rating -->
                    {!! \App\Helpers\GlobalHelper::displayReviewStars(
                        $product->reviews->count('rating'),
                        $product->reviews->count(),
                    ) !!}
                </div>
                <!-- price -->
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div>
                        @if ($product->sale_price != null || $product->sale_price > 0)
                            <span class="text-dark">&#8373; {{ $product->sale_price }}</span>
                            <span class="text-decoration-line-through text-muted">
                                &#8373; {{ $product->base_price }}
                            </span>
                        @else
                            <span class="text-dark">&#8373; {{ $product->base_price }}</span>
                        @endif
                    </div>
                    <!-- btn -->
                    <div wire:key="{{ $product->id }}">
                        @livewire('guest.component.cart-button-component', ['product' => $product], key($product->id))
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
