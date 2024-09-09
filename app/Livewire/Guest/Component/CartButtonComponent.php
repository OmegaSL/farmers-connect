<?php

namespace App\Livewire\Guest\Component;

use Livewire\Component;

class CartButtonComponent extends Component
{
    public $product;

    public function render()
    {
        return view('livewire.guest.component.cart-button-component');
    }

    public function addToCart()
    {
        dd($this->product);
        $userID = auth()->check() ? auth()->user()->id : null;
        $rowId = "product_{{$this->product->id}}";

        // add the product to cart
        \Cart::add($rowId, $this->product->name, $this->product->base_price, 1, []);
        dd(\Cart::getContent());
        // \Cart::session($userID)->add(array(
        //     'id' => $rowId,
        //     'name' => $product->name,
        //     'price' => $product->price,
        //     'quantity' => 4,
        //     'attributes' => [],
        //     'associatedModel' => $product
        // ));

        $this->dispatch('countBadges');

        $this->alert('success', 'Product added to cart.');
    }
}
