<?php

namespace App\Livewire\Guest\Modal;

use App\Traits\CartActionsTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ShopCartPreviewComponent extends Component
{
    use LivewireAlert, CartActionsTrait;

    protected $listeners = ['cartPreview'];

    public function render()
    {
        $carts = $this->cartPreview();

        return view('livewire.guest.modal.shop-cart-preview-component', [
            'carts' => $carts
        ]);
    }

    public function cartPreview()
    {
        // \Cart::clear();
        $carts = \Cart::getContent();

        // dd($carts);
        // foreach ($carts as $cart) {
        //     dd($cart['attributes']['product']);
        // }
        return $carts;
    }
}
