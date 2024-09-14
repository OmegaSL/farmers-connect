<?php

namespace App\Livewire\Guest\Pages;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Checkout extends Component
{
    use LivewireAlert;

    public $user = null;
    public $first_name;
    public $last_name;
    public $email;
    public $telephone;

    public $paymode = 'cashondelivery';

    public function mount()
    {
        if (!auth()->guard('guest')->check()) {
            return redirect()->route('login');
        }

        // check if cart is empty
        if (\Cart::isEmpty()) {
            return redirect()->route('home.page');
        }

        $this->user = auth()->guard('guest')->user();
        $this->first_name = $this->user?->first_name;
        $this->last_name = $this->user?->last_name;
        $this->email = $this->user?->email;
        $this->telephone = $this->user?->telephone;
    }

    public function render()
    {
        return view('livewire.guest.pages.checkout')->extends('livewire.guest.layouts.master');
    }

    public function updateProfile()
    {
        User::where('id', $this->user->id)->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            // 'email' => $this->email,
            'telephone' => $this->telephone
        ]);

        $this->mount();

        $this->alert('success', 'Profile updated successfully');
    }

    public function placeOrder()
    {
        if (\Cart::isEmpty()) {
            return redirect()->route('home.page');
        }

        // not done
        if ($this->paymode == 'cashondelivery') {
            // complete the cart item to order and orderitems table
            $this->user->orders()->create([
                'total_amount',
                'status'
            ]);
        }

        $this->alert('success', 'Order placed successfully');
    }
}
