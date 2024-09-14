<div>
    @if ($this->type == 'category')
        <!-- page header -->
        <div class="card mb-4 bg-light border-0">
            <!-- card body -->
            <div class="card-body p-9">
                <!-- title -->
                <h2 class="mb-0 fs-1">{{ Str::headline($category->name) }}</h2>
            </div>
        </div>
    @elseif ($this->type == 'store')
        <div class="mb-8 bg-light d-lg-flex justify-content-lg-between rounded">
            <div class="align-self-center p-8">
                <div class="mb-3">
                    <h5 class="mb-0 fw-bold">{{ $store->store_name }}</h5>
                    <p class="mb-0 text-muted">Whatever the occasion, we've got you covered.</p>
                </div>
                <div class="position-relative">
                    <input type="text" class="form-control" id="search_store"
                        wire:model.live.debounce.500ms="search_store" placeholder="Search {{ $store->store_name }}" />
                    <span class="position-absolute end-0 top-0 mt-2 me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-search">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </span>
                </div>
            </div>
            <div class="py-4">
                <!-- img -->
                <img src="{{ asset('assets/images/svg-graphics/store-graphics.svg') }}" alt="Store List"
                    class="img-fluid" />
            </div>
        </div>
    @else
        <!-- page header -->
        <div class="card mb-4 bg-light border-0">
            <!-- card body -->
            <div class="card-body p-9">
                <!-- title -->
                <h2 class="mb-0 fs-1">List of Products</h2>
            </div>
        </div>
    @endif
    <!-- list icon -->
    <div class="d-lg-flex justify-content-between align-items-center">
        <div>
            <p class="mb-3 mb-md-0">
                <span class="text-dark">{{ $count }}</span>
                Products found
            </p>
        </div>
        <!-- icon -->
        <div class="d-md-flex justify-content-between align-items-center">
            {{-- <div>
                <a href="shop-list.html" class="text-muted me-3"><i class="bi bi-list-ul"></i></a>
                <a href="shop-grid.html" class="me-3 active"><i class="bi bi-grid"></i></a>
                <a href="shop-grid-3-column.html" class="me-3 text-muted"><i class="bi bi-grid-3x3-gap"></i></a>
            </div> --}}
            <div class="d-flex mt-2 mt-lg-0">
                <div class="me-2 flex-grow-1">
                    <!-- select option -->
                    <select class="form-select" wire:model.live="perPage">
                        <option selected>Show: 50</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                    </select>
                </div>
                <div>
                    <!-- select option -->
                    <select class="form-select" wire:model.live="sortType">
                        <option value="default">Sort by: Featured</option>
                        <option value="price_asc">Price: Low to High</option>
                        <option value="price_desc">Price: High to Low</option>
                        <option value="name_asc">Name: A to Z</option>
                        <option value="name_desc">Name: Z to A</option>
                        {{-- <option value="Avg. Rating">Avg. Rating</option> --}}
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-4 row-cols-lg-5 row-cols-2 row-cols-md-3 mt-2">
        @forelse ($products as $product)
            <!-- col -->
            <div class="col">
                <!-- card product -->
                <div class="card card-product">
                    <div class="card-body">
                        <!-- badge -->
                        <div class="text-center position-relative">
                            <div class="position-absolute top-0 start-0">
                                @if ($product->sale_price != null || $product->sale_price > 0)
                                    <span class="badge bg-danger">Sale</span>
                                @endif
                            </div>
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
                                    <i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true"
                                        title="Quick View"></i>
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
                            <a href="{{ route('product.page', $product->slug) }}"
                                class="text-decoration-none text-muted">
                                <small>{{ $product->name }}</small></a>
                        </div>
                        <h2 class="fs-6">
                            <a href="{{ route('product.page', $product->slug) }}"
                                class="text-inherit text-decoration-none">
                                {!! Str::limit($product->short_description, 30, '...') !!}
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
            <!-- col -->
        @empty
            <div class="col">
                <div class="text-center">
                    <img src="{{ asset('assets/images/products/empty-box.png') }}" alt="Grocery Ecommerce Template"
                        class="img-fluid" />
                </div>
            </div>
        @endforelse
    </div>
    <!-- row -->
    <div class="row mt-8">
        <div class="col">
            <!-- nav -->
            {{ $products->links() }}
        </div>
    </div>

</div>
