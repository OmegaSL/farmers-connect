@section('title', 'Orders')

<div>

    <!-- section -->
    <section>
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- col -->
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center d-md-none py-4">
                        <!-- heading -->
                        <h3 class="fs-5 mb-0">Account Setting</h3>
                        <!-- button -->
                        <button class="btn btn-outline-gray-400 text-muted d-md-none btn-icon btn-sm ms-3" type="button"
                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasAccount" aria-controls="offcanvasAccount">
                            <i class="bi bi-text-indent-left fs-3"></i>
                        </button>
                    </div>
                </div>
                <!-- col -->
                @include('livewire.guest.shared.sidebar')
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="py-6 p-md-6 p-lg-10">
                        <!-- heading -->
                        <h2 class="mb-6">Your Orders</h2>

                        <div class="table-responsive-xxl border-0">
                            <!-- Table -->
                            <table class="table mb-0 text-nowrap table-centered">
                                <!-- Table Head -->
                                <thead class="bg-light">
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>Product</th>
                                        <th>Order</th>
                                        <th>Date</th>
                                        <th>Items</th>
                                        <th>Status</th>
                                        <th>Amount</th>

                                        {{-- <th></th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Table body -->
                                    @forelse ($order_items as $order_item)
                                        <tr>
                                            <td class="align-middle border-top-0 w-0">
                                                <a href="#">
                                                    <img src="{{ $order_item->product->image }}" alt="Ecommerce"
                                                        class="icon-shape icon-xl" />
                                                </a>
                                            </td>
                                            <td class="align-middle border-top-0">
                                                <a href="#" class="fw-semibold text-inherit"
                                                    data-bs-toggle="tooltip" data-placement="top"
                                                    title="{{ $order_item->product?->name }}">
                                                    <h6 class="mb-0">
                                                        {{ Str::limit($order_item->product?->name, 15, '...') ?? 'No Name' }}
                                                    </h6>
                                                </a>
                                                <span>
                                                    <small class="text-muted">
                                                        @foreach ($order_item->product->variants as $variant)
                                                            {{ $variant->variant_name }} |
                                                        @endforeach
                                                    </small>
                                                </span>
                                            </td>
                                            <td class="align-middle border-top-0">
                                                <a href="#"
                                                    class="text-inherit">#{{ $order_item->order?->tracking_number ?? 'N/A' }}</a>
                                            </td>
                                            <td class="align-middle border-top-0">
                                                {{ $order_item->order?->created_at->format('M d, Y') ?? 'N/A' }}
                                            </td>
                                            <td class="align-middle border-top-0">{{ $order_item->quantity }}</td>
                                            <td class="align-middle border-top-0">
                                                @if ($order_item->order->status == 'completed')
                                                    <span class="badge bg-success">
                                                        {{ $order_item->order?->status ?? 'N/A' }}
                                                    </span>
                                                @elseif ($order_item->order->status == 'pending')
                                                    <span class="badge bg-warning">
                                                        {{ $order_item->order?->status ?? 'N/A' }}
                                                    </span>
                                                @elseif ($order_item->order->status == 'canceled')
                                                    <span class="badge bg-danger">
                                                        {{ $order_item->order?->status ?? 'N/A' }}
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary">
                                                        {{ $order_item->order?->status ?? 'N/A' }}
                                                    </span>
                                                @endif
                                                {{-- <span class="badge bg-warning">
                                                    {{ $order_item->order?->status ?? 'N/A' }}
                                                </span> --}}
                                            </td>
                                            <td class="align-middle border-top-0">
                                                &#8373;{{ $order_item->order?->total_amount ?? 'N/A' }}
                                            </td>
                                            {{-- <td class="text-muted align-middle border-top-0">
                                                <a href="#" class="text-inherit" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="View"><i
                                                        class="feather-icon icon-eye"></i></a>
                                            </td> --}}
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No Orders Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
