<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Products - RMStrudio')]
class ProductsPage extends Component
{
    use WithPagination;
    public function render()
    {
        $productQuery = Product::query()->where('is_active', 1);
        return view('livewire.products-page', [
            'products' => $productQuery->paginate(6),
        ]);
    }
}
