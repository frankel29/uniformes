<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Livewire::setUpdateRoute(function($handle) {
    return Route::post('/uniformes/public/livewire/update', $handle);
});