<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\GuestController::class, 'index'])->name('home.page');
Route::get('/about-us', [App\Http\Controllers\GuestController::class, 'about_us'])->name('about_us.page');
Route::get('/contact-us', [App\Http\Controllers\GuestController::class, 'contact_us'])->name('contact_us.page');

Route::get('/shop', [App\Http\Controllers\GuestController::class, 'shop'])->name('shop.page');
Route::get('/stores', [App\Http\Controllers\GuestController::class, 'stores'])->name('stores.page');
Route::get('/shop/store/{store}', [App\Http\Controllers\GuestController::class, 'shop_with_store'])->name('shop.page.with.store');
Route::get('/shop/category/{category}', [App\Http\Controllers\GuestController::class, 'shop_with_category'])->name('shop.page.with.category');

Route::get('/shop/{slug}', [App\Http\Controllers\GuestController::class, 'product'])->name('product.page');
Route::get('/wishlists', App\Livewire\Guest\Pages\Wishlists::class)->name('wishlists.page');
Route::get('/cart', App\Livewire\Guest\Pages\CartPreview::class)->name('cart.page');
Route::get('/checkout', App\Livewire\Guest\Pages\Checkout::class)->name('checkout.page');

Route::get('/sign-in', App\Livewire\Guest\Pages\SigninComponent::class)->name('login');

Route::group(['middleware' => 'auth:guest'], function () {
    Route::get('/orders', App\Livewire\Guest\Dashboard\OrdersComponent::class)->name('user.orders');
    Route::get('/logout', [App\Http\Controllers\GuestController::class, 'logout'])->name('logout');
});
