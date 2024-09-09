<?php

namespace App\Livewire\Guest\Modal;

use App\Models\Town;
use Livewire\Component;

class FilterLocationComponent extends Component
{
    public $search_location;
    public $towns;

    public function query()
    {
        $this->towns = Town::oldest('name')
            ->when($this->search_location, fn($query) => $query->where('name', 'like', '%' . $this->search_location . '%'))
            ->take(6)
            ->get();
    }

    public function render()
    {
        $this->query();

        return view('livewire.guest.modal.filter-location-component', [
            'towns' => $this->towns,
        ]);
    }

    public function selectedTown($town)
    {
        $this->dispatch('selectedTown', $town);

        $this->search_location = $town;

        $this->query();
    }
}
