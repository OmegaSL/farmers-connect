<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Store;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        $product_categories = ProductCategory::query()
            ->withCount('products')
            ->with(
                ['products' => function ($query) {
                    $query->where('status', 'published')
                        ->where('stock', '>', 0);
                    // ->whereHas(
                    //     'variants',
                    //     function ($query) {
                    //         $query->where('stock', '>', 0);
                    //     }
                    // );
                }]
            )
            // get the top 3 categories with the most products
            ->orderBy('products_count', 'desc')
            // ->where('parent_id', null)
            ->whereHas('products', function ($query) {
                $query->where('status', 'published');
                // ->whereHas('variants', function ($query) {
                //     $query->where('stock', '>', 0);
                // });
            })
            ->where('status', 'active')
            // ->take(3)
            ->get();
        // ->shuffle()

        return view('livewire.guest.pages.home', compact('product_categories'));
    }

    public function about_us()
    {
        return view('livewire.guest.pages.about-us');
    }

    public function contact_us()
    {
        return view('livewire.guest.pages.contact-us');
    }

    public function shop()
    {
        return view('livewire.guest.pages.shop');
    }

    public function stores()
    {
        $stores = Store::query()
            ->where('status', 'active')
            ->get();

        return view('livewire.guest.pages.stores', compact('stores'));
    }

    public function shop_with_store($store)
    {
        return view('livewire.guest.pages.shop-with-store', compact('store'));
    }

    public function shop_with_category($category)
    {
        return view('livewire.guest.pages.shop-with-category', compact('category'));
    }

    public function product($slug)
    {
        $product = Product::query()
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $related_products = Product::query()
            ->whereHas('variants', function ($query) {
                $query->where('stock', '>', 0);
            })
            ->where('id', '!=', $product->id)
            ->where('category_id', $product->category_id)
            ->inRandomOrder()
            ->where('status', 'published')
            ->take(5)
            ->get();

        return view('livewire.guest.pages.product', compact('slug', 'product', 'related_products'));
    }

    public function logout()
    {
        auth()->guard('guest')->logout();

        return redirect()->route('home.page');
    }
}
