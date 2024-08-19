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
use App\Http\Controllers\ReporteVentasController;
use App\Http\Controllers\UserReportController;
use App\Http\Controllers\CancelledOrdersReportController;
use App\Http\Controllers\OrderController;

Route::get('/', HomePage::class);
Auth::routes();

// Rutas API
Route::prefix('api')->group(function () {
    Route::get('/usuarios', [ApiController::class, 'getUsers']);
    Route::get('/usuarios/{id}', [ApiController::class, 'getUserById']);
    Route::get('/colegios', [ApiController::class, 'getCategories']);
    Route::get('/colegios/{name}', [ApiController::class, 'getCategoryByName']);
    Route::get('/uniformes', [ApiController::class, 'getProducts']);
    Route::get('/uniformes/{categoryName}', [ApiController::class, 'getProductsByCategoryName']);
});

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
Route::get('/products/{slug}', ProductDetailPage::class)->name('product.detail');

//Ruta para generar un PDF
Route::get('/reporte-ventas/descargar', [ReporteVentasController::class, 'descargarPDF'])->name('reporte-ventas.descargar');

//Ruta para PDF de usuarios
Route::get('/user-report/download', [UserReportController::class, 'download'])->name('user-report.download');

//Reporte ordenes canceladas
Route::get('/cancelled-orders/download-pdf', [CancelledOrdersReportController::class, 'downloadPdf'])->name('cancelled-orders.downloadPdf');

//Generar PDF orden
Route::post('/generate-pdf', [OrderController::class, 'generatePDF'])->name('generate.pdf');




Route::middleware('guest')->group(function (){
    Route::get('/login', LoginPage::class)->name('login');
    Route::get('/register', RegisterPage::class)->name('register');
    Route::get('/forgot', ForgotPasswordPage::class)->name('forgot');
    Route::get('/reset', ResetPasswordPage::class)->name('reset');

});

Route::middleware('auth')->group(function(){
    Route::get('/logout', function(){
        auth()->logout();
        return redirect('/');
    });
    Route::get('/checkout', CheckoutPage::class)->name('checkout');
    Route::get('/my-orders', MyOrdersPage::class)->name('my.orders');  
    Route::get('/my-orders/{order}', MyOrdersDetailPage::class)->name('my.orders.detail');
    Route::get('/succes', SuccessPage::class)->name('succes');
    Route::get('/cancel', CancelPage::class)->name('cancel');
});