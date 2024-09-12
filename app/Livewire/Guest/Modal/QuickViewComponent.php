<?php

namespace App\Livewire\Guest\Modal;

use App\Models\Product;
use App\Traits\ProductActionsTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class QuickViewComponent extends Component
{
    use LivewireAlert, ProductActionsTrait;

    public $product_id;
    public ?Product $product = null;
    public float $price = 0;
    public int $quantity = 1;
    public int $available_quantity = 0;

    protected $listeners = [
        'quickProductView',
        'updateProductPrice',
    ];

    public function render()
    {
        return view('livewire.guest.modal.quick-view-component');
    }

    public function resetFields()
    {
        $this->product_id = null;
        $this->product = null;
        $this->price = 0;
        $this->quantity = 1;
    }

    public function quickProductView($product_id)
    {
        $this->product_id = $product_id;
        $this->product = Product::find($product_id);
        $this->available_quantity = $this->product->available_quantity;
        $this->selectedVariant = $this->product?->variants->first()->id ?? null;
        $this->price = $this->product->variants->first()->price + $this->product->base_price;
    }

    public function updateProductPrice($variant_id)
    {
        $this->price += $this->product->variants->find($variant_id)->price;
    }
}
