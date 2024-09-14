<?php

namespace App\Livewire\Guest\Pages;

use App\Models\Coupon;
use App\Traits\CartActionsTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CartPreview extends Component
{
    use LivewireAlert;

    public $sub_total = 0;
    public $service_fee = 0;
    public $total = 0;
    public $coupon_code;

    use CartActionsTrait;

    public function cartPreview()
    {
        $cart = \Cart::getContent();
        // dd($cart);

        $this->sub_total = $cart->reduce(function ($carry, $item) {
            return $carry + $item->price * $item->quantity;
        });
        $this->service_fee = 1;
        $this->total = $this->sub_total + $this->service_fee;

        return \Cart::getContent();
    }

    public function render()
    {
        return view('livewire.guest.pages.cart-preview', [
            'cart_list' => $this->cartPreview()
        ])->extends('livewire.guest.layouts.master');
    }

    public function redeemCode()
    {
        $this->alert('info', 'Coupon application coming soon');
        // $this->validate([
        //     'coupon_code' => 'required|exists:coupons,code'
        // ]);

        // $coupon = Coupon::where('code', $this->coupon_code)->first();
        // if ($coupon) {
        //     $this->sub_total = $this->sub_total - $coupon->discount;
        //     $this->total = $this->sub_total + $this->service_fee;
        // }

        // $couponCondition = new \Darryldecode\Cart\CartCondition([
        //     'name' => $coupon->code,
        //     'type' => 'coupon',
        //     'value' => '-' . $coupon->discount_type == 'percentage' ? $coupon->discount . '%' : $coupon->discount,
        // ]);

        // // \Cart::condition($couponCondition);
        // // append the condition to the cart
        // \Cart::condition($couponCondition);

        // $this->cartPreview();

        // dd(\Cart::getContent());
    }
}
