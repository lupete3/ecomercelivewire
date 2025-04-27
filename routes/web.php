<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ClientDashboardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ThankyouController;
use App\Http\Controllers\WishlistController;
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


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/product-category/{slug}', [CategoryController::class, 'index'])->name('product.category');
Route::get('/search-product', [SearchController::class, 'index'])->name('product.search');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/details/{slug}', [DetailController::class, 'index'])->name('details');
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
Route::get('/promotions', PromotionsComponent::class)->name('promotions');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
// Route::get('/categories', CategoriesComponent::class)->name('categories.index');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Client routes
Route::middleware(['auth'])->group(function(){
    Route::get('/client/dasboard', [ClientDashboardController::class, 'index'])->name('client.dashboard');
});

// Admin routes
Route::middleware(['auth', 'admin'])->group(function(){
    Route::get('/admin/dasboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::get('/thankyou', [ThankyouController::class, 'index'])->name('thankyou');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
