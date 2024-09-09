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
Route::get('/shop/{store}', [App\Http\Controllers\GuestController::class, 'shop_with_store'])->name('shop.page.with.store');
Route::get('/shop/category/{category}', [App\Http\Controllers\GuestController::class, 'shop_with_category'])->name('shop.page.with.category');

Route::get('/product/{slug}', [App\Http\Controllers\GuestController::class, 'product'])->name('product.page');
Route::get('/wishlists', [App\Http\Controllers\GuestController::class, 'wishlists'])->name('wishlists.page');
