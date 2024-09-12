<?php

namespace App\Livewire\Guest\Component;

use App\Traits\ProductActionsTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ProductCardComponent extends Component
{
    use LivewireAlert, ProductActionsTrait;

    public $product;

    public function mount($product)
    {
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.guest.component.product-card-component');
    }
}
