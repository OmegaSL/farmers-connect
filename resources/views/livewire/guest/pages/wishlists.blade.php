@section('title', 'Wishlists Page')

<div>
    <section class="mt-8 mb-14">
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-8">
                        <!-- heading -->
                        <h1 class="mb-1">My Wishlist</h1>
                        <p>There are {{ $wishlists->count() }} products in this wishlist.</p>
                    </div>
                    <div>
                        <!-- table -->
                        <div class="table-responsive">
                            <table class="table text-nowrap table-with-checkbox">
                                <thead class="table-light">
                                    <tr>
                                        {{-- <th>
                                            <!-- form check -->
                                            <div class="form-check">
                                                <!-- input -->
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="checkAll" />
                                                <!-- label -->
                                                <label class="form-check-label" for="checkAll"></label>
                                            </div>
                                        </th> --}}
                                        <th></th>
                                        <th>Product</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($wishlists as $wishlist)
                                        <tr>
                                            {{-- <td class="align-middle">
                                            <!-- form check -->
                                            <div class="form-check">
                                                <!-- input -->
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="chechboxTwo" />
                                                <!-- label -->
                                                <label class="form-check-label" for="chechboxTwo"></label>
                                            </div>
                                        </td> --}}
                                            <td class="align-middle">
                                                <a href="#"><img src="{{ $wishlist->product->image }}"
                                                        class="icon-shape icon-xxl" alt="" /></a>
                                            </td>
                                            <td class="align-middle">
                                                <div>
                                                    <h5 class="fs-6 mb-0">
                                                        <a href="#" class="text-inherit">
                                                            {{ $wishlist->product->name }}
                                                        </a>
                                                    </h5>
                                                    <small>
                                                        @foreach ($wishlist->product->variants as $variant)
                                                            {{ $variant->variant_name }} |
                                                        @endforeach
                                                        {{-- $.98 / lb --}}
                                                    </small>
                                                </div>
                                            </td>
                                            <td class="align-middle">&#8373;{{ $wishlist->product->base_price }}</td>
                                            <td class="align-middle">
                                                @if ($wishlist->product->variants->sum('stock') > 0)
                                                    <span class="badge bg-success">
                                                        In Stock
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger">
                                                        Out of Stock
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                @if ($wishlist->product->variants->sum('stock') > 0)
                                                    @livewire('guest.component.cart-button-component', ['product' => $wishlist->product, 'type' => 'wishlist'])
                                                @else
                                                    <div class="btn btn-dark btn-sm">
                                                        <a href="{{ route('contact_us.page') }}" class="text-white">
                                                            Contact us
                                                        </a>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                <a href="#" class="text-muted" data-bs-toggle="tooltip"
                                                    wire:click='removeFromWishList({{ $wishlist->id }})'
                                                    data-bs-placement="top" title="Delete">
                                                    <i class="feather-icon icon-trash-2"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No Products Found</td>
                                        </tr>
                                    @endforelse
                                    {{-- <tr>
                                    <td class="align-middle">
                                        <a href="#"><img src="../assets/images/products/product-img-17.jpg"
                                                class="icon-shape icon-xxl" alt="" /></a>
                                    </td>
                                    <td class="align-middle">
                                        <div>
                                            <h5 class="fs-6 mb-0"><a href="#" class="text-inherit">Fresh
                                                    Kiwi</a>
                                            </h5>
                                            <small>4 no</small>
                                        </div>
                                    </td>
                                    <td class="align-middle">$20.97</td>
                                    <td class="align-middle"><span class="badge bg-danger">Out of Stock</span></td>
                                    <td class="align-middle">
                                        <div class="btn btn-dark btn-sm">Contact us</div>
                                    </td>
                                    <td class="align-middle">
                                        <a href="#" class="text-muted" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Delete">
                                            <i class="feather-icon icon-trash-2"></i>
                                        </a>
                                    </td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
