<div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-6">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="mb-1" id="locationModalLabel">Choose Your Location</h5>
                            <p class="mb-0 small">Enter the address and we will filter the product in that area.</p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="my-5">
                        <input type="search" class="form-control" placeholder="Search your area"
                            wire:model.live='search_location' />
                    </div>
                    {{-- <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="mb-0">Select Location</h6>
                        <a href="#" class="btn btn-outline-gray-400 text-muted btn-sm">Clear All</a>
                    </div> --}}
                    <div>
                        <div data-simplebar style="height: 300px">
                            <div class="list-group list-group-flush">
                                @forelse ($towns as $town)
                                    <a href="#!" wire:click.prevent='selectedTown("{{ $town->name }}")'
                                        class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action active">
                                        <span>{{ $town->name }}</span>
                                        <span>{{ $town->district?->name ?? 'N/A' }}</span>
                                    </a>
                                @empty
                                    <p>No data found</p>
                                @endforelse
                                {{-- <a href="#"
                                    class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                    <span>Alaska</span>
                                    <span>Min:$30</span>
                                </a>
                                <a href="#"
                                    class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                    <span>Arizona</span>
                                    <span>Min:$50</span>
                                </a>
                                <a href="#"
                                    class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                    <span>California</span>
                                    <span>Min:$29</span>
                                </a>
                                <a href="#"
                                    class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                    <span>Colorado</span>
                                    <span>Min:$80</span>
                                </a>
                                <a href="#"
                                    class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                    <span>Florida</span>
                                    <span>Min:$90</span>
                                </a>
                                <a href="#"
                                    class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                    <span>Arizona</span>
                                    <span>Min:$50</span>
                                </a>
                                <a href="#"
                                    class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                    <span>California</span>
                                    <span>Min:$29</span>
                                </a>
                                <a href="#"
                                    class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                    <span>Colorado</span>
                                    <span>Min:$80</span>
                                </a>
                                <a href="#"
                                    class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                    <span>Florida</span>
                                    <span>Min:$90</span>
                                </a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@script
    {{-- close on livewire event --}}
    <script>
        window.addEventListener('selectedTown', event => {
            $('#locationModal').modal('hide');
        });
    </script>
@endscript
