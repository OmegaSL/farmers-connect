<?php

namespace App\Livewire\Guest\Dashboard;

use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;
use Livewire\WithPagination;

class OrdersComponent extends Component
{
    use WithPagination;

    public $perPage = 10;

    public function render()
    {
        return view('livewire.guest.dashboard.orders-component', [
            'order_items' => OrderItem::query()
                ->whereHas('order', function ($query) {
                    $query->where('user_id', auth()->user()?->id);
                })
                ->paginate($this->perPage),
        ])->extends('livewire.guest.layouts.master');
    }

    public function previewOrder($id)
    {
        return Order::query()->where('id', $id)->first();
    }
}
