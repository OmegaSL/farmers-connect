@extends('livewire.guest.layouts.master')

@section('title', 'Store Page')

@section('content')

    <!-- section -->
    <section class="mt-8">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-12">
                    <!-- heading -->
                    <div class="bg-light d-flex justify-content-between ps-md-10 ps-6 rounded">
                        <div class="d-flex align-items-center">
                            <h1 class="mb-0 fw-bold">Stores</h1>
                        </div>
                        <div class="py-6">
                            <!-- img -->
                            <!-- img -->
                            <img src="../assets/images/svg-graphics/store-graphics.svg" alt="" class="img-fluid" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- section -->
    <section class="mt-8 mb-lg-14 mb-8">
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- col -->
                <div class="col-12">
                    <div class="mb-3">
                        <!-- text -->
                        <h6>
                            We have
                            <span class="text-primary">{{ $stores->count() }}</span>
                            vendors now
                        </h6>
                    </div>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3 g-4 g-lg-4">
                @forelse ($stores as $store)
                    <!-- col -->
                    <div class="col">
                        <!-- card -->
                        <div class="card p-6 card-product">
                            <div>
                                <!-- img -->
                                <img src="{{ asset('assets/images/stores-logo/stores-logo-6.svg') }}" alt=""
                                    class="rounded-circle icon-shape icon-xl" />
                            </div>
                            <div class="mt-4">
                                <!-- content -->
                                <h2 class="mb-1 h5"><a href="{{ route('shop.page.with.store', $store->store_slug) }}"
                                        class="text-inherit">{{ $store->store_name }}</a></h2>
                                <div class="small text-muted">
                                    <span class="me-2">{{ $store->address }}</span>
                                    {{-- <span class="me-2">Organic</span> --}}
                                    {{-- <span class="me-2">Groceries</span>
                                    <span>Butcher Shop</span> --}}
                                </div>
                                <div class="py-3">
                                    <ul class="list-unstyled mb-0 small">
                                        <li>Delivery</li>
                                        <li>Pickup available</li>
                                    </ul>
                                </div>
                                <div>
                                    <!-- badge -->
                                    <div class="badge text-bg-light border">
                                        {{ $store->town?->district?->region?->name ?? 'N/A' }} Region</div>
                                    <!-- badge -->
                                    <div class="badge text-bg-light border">{{ $store->town?->district?->name ?? 'N/A' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col">
                        <p>No data found</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

@endsection
