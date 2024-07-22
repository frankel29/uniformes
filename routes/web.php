<?php

use App\Livewire\Auth\ResetPasswordPage;
use App\Livewire\CancelPage;
use App\Livewire\SuccessPage;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use App\Http\Controllers\HomeController;
use App\Livewire\HomePage;
use App\Livewire\CategoriesPage;
use App\Livewire\ProductsPage;
use App\Livewire\CartPage;
use App\Livewire\ProductDetailPage;
use App\Livewire\CheckoutPage;
use App\Livewire\MyOrdersPage;
use App\Livewire\MyOrdersDetailPage;
use App\Livewire\Auth\LoginPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\Auth\ForgotPasswordPage;

Route::get('/', HomePage::class);
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Livewire::setUpdateRoute(function($handle) {
    return Route::post('/uniformes/public/livewire/update', $handle);
});

// Ruta a CategoriesPage
Route::get('/categories', CategoriesPage::class)->name('categories');

// Ruta a ProductsPage
Route::get('/products', ProductsPage::class)->name('products');

// Ruta a CartPage
Route::get('/cart', CartPage::class)->name('cart');

// Ruta a ProductDetailPage
Route::get('/products/{product}', ProductDetailPage::class)->name('product.detail');

// Ruta a CheckoutPage
Route::get('/checkout', CheckoutPage::class)->name('checkout');

// Ruta a MyOrdersPage
Route::get('/my-orders', MyOrdersPage::class)->name('my.orders');

// Ruta a MyOrdersDetailPage
Route::get('/my-orders/{order}', MyOrdersDetailPage::class)->name('my.orders.detail');

Route::get('/login', LoginPage::class)->name('login');

Route::get('/register', RegisterPage::class)->name('register');

Route::get('/forgot', ForgotPasswordPage::class)->name('forgot');


Route::get('/reset', ResetPasswordPage::class)->name('reset');

Route::get('/succes', SuccessPage::class)->name('succes');

Route::get('/cancel', CancelPage::class)->name('cancel');

