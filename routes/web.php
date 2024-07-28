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

// Rutas públicas
Route::get('/', HomePage::class)->name('home');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/categories', CategoriesPage::class)->name('categories');
Route::get('/products', ProductsPage::class)->name('products');
Route::get('/cart', CartPage::class)->name('cart');
Route::get('/products/{product}', ProductDetailPage::class)->name('product.detail');
Route::get('/checkout', CheckoutPage::class)->name('checkout');

Route::get('/login', LoginPage::class)->name('login');
Route::get('/register', RegisterPage::class)->name('register');
Route::get('/reset', ResetPasswordPage::class)->name('password.reset');
Route::get('/forgot', ForgotPasswordPage::class)->name('password.request');

Route::get('/success', SuccessPage::class)->name('payment.success');
Route::get('/cancel', CancelPage::class)->name('payment.cancel');

// Rutas protegidas por middleware de autenticación
Route::middleware('auth')->group(function(){
    Route::get('/logout', function(){
        auth()->logout();
        return redirect('/');
    })->name('logout');
    
    Route::get('/my-orders', MyOrdersPage::class)->name('my.orders');
    Route::get('/my-orders/{order}', MyOrdersDetailPage::class)->name('my.orders.detail');
});

// Configuración de Livewire
Livewire::setUpdateRoute(function($handle) {
    return Route::post('/uniformes/public/livewire/update', $handle);
});
