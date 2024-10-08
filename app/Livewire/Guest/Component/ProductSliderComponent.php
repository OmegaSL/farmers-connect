<?php

namespace App\Livewire\Guest\Component;

use App\Models\Product;
use Livewire\Component;
use App\Models\ProductCategory;
use App\Traits\ProductActionsTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProductSliderComponent extends Component
{
    use LivewireAlert, ProductActionsTrait;

    public ProductCategory $product_category;

    public $products;

    public $title;
    public $description;

    public function mount($product_category)
    {
        $this->title = $product_category->name;
        $this->description = $product_category->description;
        $this->products = $product_category->products()->take(10)->get();
        // dd($product_category, $this->products);
    }

    public function render()
    {
        return view('livewire.guest.component.product-slider-component');
    }
}
