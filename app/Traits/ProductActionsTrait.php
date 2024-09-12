<?php

namespace App\Traits;

use App\Models\Product;
use App\Models\WishList;

trait ProductActionsTrait
{
    public $selectedVariant = null;

    public function addToWishList($product_id)
    {
        $product = Product::find($product_id);

        if (auth()->guard('guest')->check()) {
            WishList::updateOrCreate(['user_id' => auth()->user()->id, 'product_id' => $product->id], [
                'user_id' => auth()->user()->id,
                'product_id' => $product->id
            ]);
        } else {
            $this->alert('warning', 'Please login to add product to wishlist');
            return;
        }

        $this->dispatch('countBadges');

        $this->alert('success', 'Product added to wishlist');
    }

    public function quickView($product_id)
    {
        $this->dispatch('quickProductView', $product_id);
    }

    public function incrementQuantity()
    {
        if ($this->quantity < $this->available_quantity) {
            $this->quantity++;
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function updatedQuantity()
    {
        if ($this->quantity == '' || $this->quantity == null || $this->quantity == 0) {
            $this->quantity = 1;
        }

        if ($this->quantity > $this->available_quantity) {
            $this->quantity = $this->available_quantity;
        }
    }

    public function addToCart($product_id)
    {
        $this->dispatch('addToCart', $product_id);
    }

    public function selectVariant($variant_id)
    {
        $this->selectedVariant = $variant_id;

        // update product price with selected variant price
        $this->dispatch('updateProductPrice', $this->selectedVariant);
    }
}
