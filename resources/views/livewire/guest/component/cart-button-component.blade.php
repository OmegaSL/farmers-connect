<div>
    @if ($type == 'single_product')
        <button type="button" class="btn btn-primary" wire:click.prevent='addToCart'>
            <i class="feather-icon icon-shopping-bag me-2"></i>
            Add to cart
        </button>
    @else
        <a href="#!" wire:click.prevent='addToCart' class="btn btn-primary btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-plus">
                <line x1="12" y1="5" x2="12" y2="19">
                </line>
                <line x1="5" y1="12" x2="19" y2="12">
                </line>
            </svg>
            Add
        </a>
    @endif
</div>
