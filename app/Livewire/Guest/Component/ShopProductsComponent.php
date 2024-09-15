<?php

namespace App\Livewire\Guest\Component;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Store;
use App\Traits\ProductActionsTrait;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ShopProductsComponent extends Component
{
    use WithPagination, LivewireAlert, ProductActionsTrait;

    public $paginationTheme = 'bootstrap';

    public string $type = 'shop';

    public $category_slug;
    public $store_slug;

    public $search_store = '';
    public $queryString = ['search_store'];

    public $perPage = 15;

    public $sortType = 'default';
    public $sortBy = 'created_at';
    public $sortDirection = 'asc';

    public function mount($type)
    {
        $this->type = $type;
    }

    public function render()
    {
        $category = null;
        $store = null;

        if ($this->sortType == 'price_asc') {
            $this->sortBy = 'base_price';
            $this->sortDirection = 'asc';
        } elseif ($this->sortType == 'price_desc') {
            $this->sortBy = 'base_price';
            $this->sortDirection = 'desc';
        } elseif ($this->sortType == 'name_asc') {
            $this->sortBy = 'name';
            $this->sortDirection = 'asc';
        } elseif ($this->sortType == 'name_desc') {
            $this->sortBy = 'name';
            $this->sortDirection = 'desc';
        } elseif ($this->sortType == 'default') {
            $this->sortBy = 'created_at';
            $this->sortDirection = 'desc';
        }

        switch ($this->type) {
            case 'category':
                $products = Product::query()
                    // ->whereHas('variants', function ($query) {
                    //     $query->where('stock', '>', 0);
                    // })
                    ->where('stock', '>', 0)
                    ->where('status', 'published')
                    ->whereHas('product_category', function ($query) {
                        $query->where('slug', $this->category_slug);
                    })
                    ->orderBy($this->sortBy, $this->sortDirection);

                $category = ProductCategory::where('slug', $this->category_slug)->first();
                break;

            case 'store':
                $products = Product::query()
                    // ->where('name', 'like', '%' . $this->search_store . '%')
                    ->when($this->search_store, fn($query) => $query->where('name', 'like', '%' . $this->search_store . '%'))
                    // ->whereHas('variants', function ($query) {
                    //     $query->where('stock', '>', 0);
                    // })
                    ->where('stock', '>', 0)
                    ->where('status', 'published')
                    ->whereHas('store', function ($query) {
                        $query->where('store_slug', $this->store_slug);
                    })
                    ->orderBy($this->sortBy, $this->sortDirection);

                $store = Store::where('store_slug', $this->store_slug)->first();
                break;
            case 'shop':
                $products = Product::query()
                    // ->whereHas('variants', function ($query) {
                    //     $query->where('stock', '>', 0);
                    // })
                    ->where('stock', '>', 0)
                    ->where('status', 'published')
                    ->orderBy($this->sortBy, $this->sortDirection);
                break;
            default:
                $products = Product::query()
                    // ->whereHas('variants', function ($query) {
                    //     $query->where('stock', '>', 0);
                    // })
                    ->where('stock', '>', 0)
                    ->where('status', 'published')
                    ->orderBy($this->sortBy, $this->sortDirection);
                break;
        }

        $count = $products->count();

        return view('livewire.guest.component.shop-products-component', [
            'products' => $products->paginate($this->perPage),
            'category' => $category,
            'store' => $store,
            'count' => $count
        ]);
    }
}
