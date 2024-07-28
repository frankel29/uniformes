<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Products - RMStrudio')]
class ProductsPage extends Component
{
    use WithPagination;

    #[Url]
    public $featured;

    #[Url]
    public $on_sale;

    #[Url]
    public $selected_categories = [];

    public function render()
    {
        $productQuery = Product::query()->where('is_active', 1);

        if(!empty($this->selected_categories)) {
          $productQuery->whereIn('category_id', $this->selected_categories);    
        }

        if($this->featured){
          $productQuery->where('is_featured', 1);  
        }

        if($this->on_sale){
            $productQuery->where('on_sale', 1);  
          } 

        return view('livewire.products-page', [
            'products' => $productQuery->paginate(9),
            'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug']),
        ]);
    }
}
