<?php

namespace App\Livewire\Guest\Component;

use App\Helpers\GlobalHelper;
use App\Models\Product;
use App\Models\WishList;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CartButtonComponent extends Component
{
    use LivewireAlert;

    public $product;
    public string $type = 'multi_product';
    public int $quantity = 1;

    public function render()
    {
        return view('livewire.guest.component.cart-button-component');
    }

    public function addToCart()
    {
        // dd($this->product);
        $userID = auth()->guard('guest')->check() ? auth()->guard('guest')->user()->id : null;
        $rowId = "product_{{$this->product->id}}";

        // check if the product has variants
        // if ($this->product->variants->count() == 0) {
        //     $this->alert('error', 'This product has no stock available.');
        //     return;
        // }

        // check if the product has stock
        if ($this->product->stock <= 0) {
            $this->alert('error', 'This product has no stock available.');
            return;
        }

        // pick the first variant from the product
        // $product_variant = $this->product->variants->first();

        // calculate the percent off when product has sale price
        $saleCondition = [];
        if ($this->product->sale_price != null || $this->product->sale_price > 0) {
            $percent_off = GlobalHelper::percentageOff($this->product->base_price, $this->product->sale_price);

            $saleCondition = new \Darryldecode\Cart\CartCondition([
                'name' => 'Sale ' . $percent_off,
                'type' => 'sale',
                'value' =>  $percent_off,
            ]);
        }

        $product = [
            'id' => $rowId,
            'name' => $this->product->name,
            'price' => $this->product->sale_price ?? $this->product->base_price,
            'quantity' => $this->quantity,
            'attributes' => [
                'product' => $this->product,
                // 'variant' => $product_variant ?? null,
            ],
            'conditions' => $saleCondition
        ];

        // add the product to cart
        \Cart::add($product);
        // \Cart::session($userID)->add(array(
        //     'id' => $rowId,
        //     'name' => $product->name,
        //     'price' => $product->price,
        //     'quantity' => 4,
        //     'attributes' => [],
        //     'associatedModel' => $product
        // ));

        $this->dispatch('countBadges');

        $this->dispatch('cartPreview');

        $this->alert('success', 'Product added to cart.');
    }

    public function moveToCart($rowId)
    {
        $this->product = Product::find($rowId);

        $this->addToCart();

        $wishlists = WishList::query()->where('user_id', auth()->guard('guest')->user()?->id)->get();
        foreach ($wishlists as $wishlist) {
            if ($wishlist->product_id == $rowId) {
                $wishlist->delete();
            }
        }

        // \Cart::remove($rowId);
        // \Cart::add($product);
        $this->dispatch('wishlistPreview');
        $this->alert('success', 'Product moved to cart.');
    }
}
