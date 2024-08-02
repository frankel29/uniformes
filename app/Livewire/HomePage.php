<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category; // Asegúrate de tener esta importación

class HomePage extends Component
{
    public $categories;

    public function mount()
    {
        $this->categories = Category::all(); // O la consulta que necesites
    }

    public function render()
    {
        return view('livewire.home-page');
    }
}

