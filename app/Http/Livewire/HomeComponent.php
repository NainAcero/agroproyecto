<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Producto;

class HomeComponent extends Component
{
    public function render()
    {
        $categories = Category::all();
        $popular_products = Producto::orderBy('created_at', 'DESC')->limit(8)->get();
        return view('livewire.home-component', [
            'categories' => $categories,
            'popular_products' => $popular_products
        ])->layout('layouts.base');
    }
}
