<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use App\Livewire\HomePage;

Route::get('/', HomePage::class);