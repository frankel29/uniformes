<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Filament\Http\Middleware\Authenticate; // Importa el middleware de autenticación de Filament
use App\Livewire\HomePage;


Route::get('/', HomePage::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Livewire::setUpdateRoute(function($handle) {
    return Route::post('/uniformes/public/livewire/update', $handle);
});