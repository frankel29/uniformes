<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;

class CategoriesPage extends Component
{
    public $categories;

    public function mount()
    {
        $this->categories = Category::all(); // O la consulta que necesites
    }

    public function render()
    {
        return view('livewire.categories-page');
    }
}
