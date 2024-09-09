<div>

    <form action="#">
        <div class="input-group">
            <select class="form-select d-lg-block d-none" name="category" wire:model.live="search_category">
                <option selected>All Categories</option>
                @forelse ($product_categories as $category)
                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                @empty
                    <option value="all">All Categories</option>
                @endforelse
            </select>
            <input type="text" aria-label="Last name" class="form-control w-45" placeholder="Search for products"
                name="query" wire:model.live="query" wire:keydown.escape="resetFields" wire:keydown.tab="resetFields"
                wire:keydown.arrow-up="decrementHighlight" wire:keydown.arrow-down="incrementHighlight"
                wire:keydown.enter="selectProduct" />
            {{-- <button class="input-group-text bg-transparent" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-search">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </button> --}}

            @if (!empty($query) || !empty($products))
                <button class="input-group-text bg-transparent" type="button" wire:click='resetFields'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-x-lg" viewBox="0 0 16 16">
                        <path
                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                    </svg>
                </button>
            @endif
        </div>

        <div class="input-group {{ empty($products) && empty($query) ? 'd-none' : '' }} my-3" style="z-index: 999;">
            <div wire:loading class="card position-absolute shadow bg-body rounded-start w-100">
                <div class="w-full text-dark">
                    <div class="card-body">Searching...</div>
                </div>
            </div>
            @if (!empty($query))
                <div class="card position-absolute shadow bg-body rounded-start w-100">
                    <div class="card-body">
                        @if (!empty($products))
                            @foreach (array_slice($products, 0, 10) as $key => $product)
                                <a href="{{ route('product.page', $product['slug']) }}" style="box-sizing: border-box;"
                                    class="{{ $highlightIndex === $key ? 'card-link inline-block' : '' }}">
                                    <h5 class="card-title {{ $highlightIndex === $key ? 'shadow' : '' }}">
                                        <img height="50px" width="50px" src="{{ $product['image'] }}" alt="">
                                        &nbsp;{{ $product['name'] }}
                                    </h5>
                                </a>
                            @endforeach
                        @else
                            <div class="card-link">No results!</div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </form>

</div>
