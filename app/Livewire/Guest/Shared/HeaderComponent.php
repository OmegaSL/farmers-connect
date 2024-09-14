<?php

namespace App\Livewire\Guest\Shared;

use Livewire\Component;
use App\Models\WishList;

class HeaderComponent extends Component
{
    public int $wishlist_count = 0;
    public int $cart_count = 0;
    public bool $is_logged_in = false;

    protected $listeners = ['countBadges', 'isLoggedIn'];

    public function mount()
    {
        $this->countBadges();
        $this->is_logged_in = auth()->guard('guest')->check();
    }

    public function render()
    {
        return view('livewire.guest.shared.header-component');
    }

    public function countBadges()
    {
        // dd($this->wishlist_count, $this->cart_count);
        $this->wishlist_count = WishList::count();

        $this->cart_count = \Cart::getContent()->count();
    }

    public function isLoggedIn()
    {
        $this->is_logged_in = true;
    }
}
