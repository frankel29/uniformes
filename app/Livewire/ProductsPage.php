<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Models\Product;
use App\Models\Category;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Products - RMStrudio')]
class ProductsPage extends Component
{
    use LivewireAlert;
    use WithPagination;

    #[Url]
    public $featured;

    #[Url]
    public $on_sale;

    #[Url]
    public $selected_categories = [];

    public function mount()
    {
        // Obtener el parámetro de la URL para las categorías
        $this->selected_categories = request()->query('category') ? [request()->query('category')] : [];
    }

    public function addToCart($product_id)
    {
        $total_count = CartManagement::addItemToCart($product_id);

        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);

        $this->alert('success', 'Producto añadido al carrito satisfactoriamente!', [
            'position' => 'bottom-end',
            'timer' => 3000,
            'toast' => true,
        ]);
    }

    public function render()
    {
        $productQuery = Product::query()->where('is_active', 1);

        if (!empty($this->selected_categories)) {
            $productQuery->whereIn('category_id', $this->selected_categories);
        }

        if ($this->featured) {
            $productQuery->where('is_featured', 1);
        }

        if ($this->on_sale) {
            $productQuery->where('on_sale', 1);
        }

        return view('livewire.products-page', [
            'products' => $productQuery->paginate(9),
            'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug']),
        ]);
    }
}
