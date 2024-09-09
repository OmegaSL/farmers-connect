<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        $product_categories = ProductCategory::query()
            ->withCount('products')
            // get the top 3 categories with the most products
            ->orderBy('products_count', 'desc')
            ->where('parent_id', null)
            ->whereHas('products', function ($query) {
                $query->where('status', 'published');
            })
            ->where('status', 'active')
            ->take(3)
            ->get()
            ->shuffle();

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
        return view('livewire.guest.pages.stores');
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
        return view('livewire.guest.pages.product', compact('slug'));
    }

    public function wishlists()
    {
        return view('livewire.guest.pages.wishlists');
    }
}
