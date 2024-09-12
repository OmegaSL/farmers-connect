<?php

namespace App\Livewire\Guest\Component;

use App\Models\Product;
use App\Traits\ProductActionsTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ProductOverviewComponent extends Component
{
    use LivewireAlert, ProductActionsTrait;

    public $product_slug;
    public ?Product $product;
    public float $price = 0;
    public int $quantity = 1;
    public int $available_quantity = 0;

    public function mount($product_slug)
    {
        $this->product_slug = $product_slug;
        $this->product = \App\Models\Product::where('slug', $product_slug)->first();
        $this->available_quantity = $this->product->available_quantity;
        $this->selectedVariant = $this->product?->variants->first()->id ?? null;
        $this->price = $this->product->variants->first()->price + $this->product->base_price;
    }

    public function render()
    {
        return view('livewire.guest.component.product-overview-component');
    }
}
