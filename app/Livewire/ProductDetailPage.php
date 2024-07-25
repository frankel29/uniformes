<?php

namespace App\Livewire;

use App\Models\Product; // Asegúrate de importar el modelo Product
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Product Detail - RMStrudio')]
class ProductDetailPage extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $product = Product::where('slug', $this->slug)->firstOrFail(); // Nota: Usa firstOrFail() en lugar de firstOrFall()

        return view('livewire.product-detail-page', [
            'product' => $product,
        ]);
    }
}
