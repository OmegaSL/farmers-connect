<?php

namespace App\Livewire\Guest\Shared;

use App\Models\Product;
use App\Models\Town;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;

class HeaderSearchFilterComponent extends Component
{
    public $query;
    public $search_category;
    public $selectedTown;
    public $products;
    public $highlightIndex;

    public function mount()
    {
        $this->resetFields();
    }

    // listen to event from product component
    protected $listeners = [
        'refreshComponent' => '$refresh',
        'removeFromCart',
        'selectedTown',
    ];

    public function render()
    {
        $wishlist_count = \App\Models\WishList::query()
            ->where('user_id', auth()->id())
            ->count() ?? 0;

        return view('livewire.guest.shared.header-search-filter-component', [
            'wishlist_count' => $wishlist_count,

            // 'product_categories_with_sub' => \App\Models\ProductCategory::query()
            //     ->with(['sub_categories'])
            //     ->withCount('sub_categories')
            //     // ->whereHas('sub_categories', function ($query) {
            //     //     $query->whereHas('products', function ($query) {
            //     //         $query->where('status', 'published');
            //     //     })->where('status', 'active');
            //     // })
            //     ->whereHas('products', function ($query) {
            //         $query->where('status', 'published');
            //     })
            //     ->orderBy('sub_categories_count', 'desc')
            //     ->where('status', 'active')->get(),
            // 'product_categories_without_sub' => \App\Models\ProductCategory::query()
            //     ->with(['sub_categories'])
            //     ->whereDoesntHave('sub_categories', function ($query) {
            //         $query->where('status', 'active')->orderBy('created_at', 'desc');
            //     })
            //     ->whereHas('products', function ($query) {
            //         $query->where('status', 'published');
            //     })
            //     ->doesntHave('parent')
            //     ->where('status', 'active')->get(),
            'product_categories' => \App\Models\ProductCategory::query()
                ->with(['sub_categories'])
                ->whereHas('products', function ($query) {
                    $query->where('status', 'published');
                })
                ->where('status', 'active')->get(),
        ]);
    }

    public function resetFields()
    {
        $this->query = '';
        $this->search_category = '';
        $this->products = [];
        $this->highlightIndex = 0;
    }

    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->products) - 1) {
            $this->highlightIndex = 0;
            return;
        }
        $this->highlightIndex++;
    }

    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->products) - 1;
            return;
        }
        $this->highlightIndex--;
    }

    public function selectProduct()
    {
        $product = $this->products[$this->highlightIndex] ?? null;
        if ($product) {
            $this->redirect(route('product.page', $product['slug']));
        }
    }

    public function updatedSearchCategory()
    {
        $this->updatedQuery();
    }

    public function selectedTown($town)
    {
        $this->selectedTown = $town;

        $this->updatedQuery();
    }

    public function updatedQuery()
    {
        $this->products = Product::query()
            ->when($this->search_category, function ($query) {
                return $query->whereHas('product_category', function ($query) {
                    $query->where('name', 'like', '%' . $this->search_category . '%');
                });
            })
            ->when($this->selectedTown, function ($query) {
                $query->whereHas('store', function ($query) {
                    $query->whereHas('town', function ($query) {
                        $query->where('name', 'like', '%' . $this->selectedTown . '%');
                    });
                });
            })
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->query . '%')
                    ->orWhere('short_description', 'like', '%' . $this->query . '%')
                    ->orWhere('long_description', 'like', '%' . $this->query . '%');
            })
            ->where('status', 'published')
            ->get()
            ->take(15)
            ->toArray();

        // $this->products = Product::where(function (Builder $query) {
        //     $query->whereRaw("MATCH (name, short_description, long_description) AGAINST (? IN BOOLEAN MODE)", [$this->query]);
        // })
        //     ->where('status', 'published')
        //     ->get()
        //     ->toArray();
    }
}
