<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\AboutComponent;
use App\Livewire\Admin\AdminDashboardComponemt;
use App\Livewire\Admin\Categories\CategoriesComponent;
use App\Livewire\CartComponent;
use App\Livewire\CheckoutComponent;
use App\Livewire\Client\ClientDashboardComponent;
use App\Livewire\DetailsComponent;
use App\Livewire\HomeComponent;
use App\Livewire\ShopComponent;
use App\Livewire\CategoryComponent;
use App\Livewire\ContactComponent;
use App\Livewire\PromotionsComponent;
use App\Livewire\SearchComponent;
use App\Livewire\ThankyouComponent;
use App\Livewire\WishlistComponent;
use Illuminate\Support\Facades\Route;


Route::get('/', HomeComponent::class)->name('home');
Route::get('/shop', ShopComponent::class)->name('shop');
Route::get('/product-category/{slug}', CategoryComponent::class)->name('product.category');
Route::get('/search-product', SearchComponent::class)->name('product.search');
Route::get('/cart', CartComponent::class)->name('cart');
Route::get('/details/{slug}', DetailsComponent::class)->name('details');
Route::get('/wishlist', WishlistComponent::class)->name('wishlist');
Route::get('/promotions', PromotionsComponent::class)->name('promotions');
Route::get('/about', AboutComponent::class)->name('about');
Route::get('/contact', ContactComponent::class)->name('contact');
// Route::get('/categories', CategoriesComponent::class)->name('categories.index');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Client routes
Route::middleware(['auth'])->group(function(){
    Route::get('/client/dasboard', ClientDashboardComponent::class)->name('client.dashboard');
});

// Admin routes
Route::middleware(['auth', 'admin'])->group(function(){
    Route::get('/admin/dasboard', AdminDashboardComponemt::class)->name('admin.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/checkout', CheckoutComponent::class)->name('checkout');
    Route::get('/thankyou', ThankyouComponent::class)->name('thankyou');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
