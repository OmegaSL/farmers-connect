<?php

namespace App\Livewire\Guest\Shared;

use Livewire\Component;
use App\Models\WishList;

class HeaderComponent extends Component
{
    public int $wishlist_count = 0;
    public int $cart_count = 0;

    protected $listeners = ['countBadges'];

    public function mount()
    {
        $this->wishlist_count = 0;

        $this->cart_count = 0;
    }

    public function render()
    {
        return view('livewire.guest.shared.header-component');
    }

    public function countBadges()
    {
        $this->wishlist_count = WishList::count();

        $this->cart_count = 0;
    }
}
