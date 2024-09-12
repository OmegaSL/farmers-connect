<?php

namespace App\Traits;

trait CartActionsTrait
{
    public function updateCart()
    {
        $this->cartPreview();
    }

    public function increaseCartQuantity($rowId)
    {
        \Cart::update($rowId, ['quantity' => 1]);

        $this->cartPreview();
    }

    public function decreaseCartQuantity($rowId)
    {
        // before updating, check if the quantity is 1
        $product = \Cart::get($rowId);

        if ($product->quantity <= 1) {
            return;
        }

        \Cart::update($rowId, ['quantity' => -1]);

        $this->cartPreview();
    }

    public function removeFromCart($rowId)
    {
        \Cart::remove($rowId);

        $this->cartPreview();
    }

    public function clearCart()
    {
        \Cart::clear();

        $this->cartPreview();
    }
}
