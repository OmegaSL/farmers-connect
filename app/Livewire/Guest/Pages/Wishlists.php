<?php

namespace App\Livewire\Guest\Pages;

use App\Models\WishList;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Wishlists extends Component
{
    use LivewireAlert;

    protected $listeners = [
        'wishlistPreview'
    ];

    public function render()
    {
        $wishlists = $this->wishlistPreview();

        return view('livewire.guest.pages.wishlists', [
            'wishlists' => $wishlists,
        ])->extends('livewire.guest.layouts.master');
    }

    public function wishlistPreview()
    {
        $wishlists = WishList::query()
            // ->where('user_id', auth()->user()?->id)
            ->get();

        return $wishlists;
    }

    public function removeFromWishList($id)
    {
        $wishlists = WishList::query()->where('id', $id)->first();

        $wishlists->delete();

        $this->wishlistPreview();

        $this->alert('success', 'Product removed from wishlist. ');
    }
}
