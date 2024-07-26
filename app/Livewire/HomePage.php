<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\Component\Title;


#[Title('RM Sports')]
class HomePage extends Component
{
    public function render()
    {
        $categories = Category::where('is_active', 1)->get(); 
        //dd($categories);
        return view('livewire.home-page', [
            'categories' => $categories  
        ]);
    }
}
