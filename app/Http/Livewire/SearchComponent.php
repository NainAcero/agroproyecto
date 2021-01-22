<?php

namespace App\Http\Livewire;

use App\Models\Producto;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
use App\Models\Category;

class SearchComponent extends Component
{
    public $sorting;
    public $pageSize;

    public $search;
    public $product_cat;
    public $product_cat_id;

    public function mount(){
        $this->sorting = "default";
        $this->pageSize = 12;
        $this->fill(request()->only('search','product_cat', 'product_cat_id'));
    }

    public function store($product_id, $product_name, $product_price){
        Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Producto');
        session()->flash('success_message', 'Item added in Cart');
        return redirect()->route('product.cart');
    }

    use WithPagination;

    public function render()
    {
        if($this->sorting == 'date'){
            $products = Producto::where('name','like','%'. $this->search .'%')->where('category_id','like', '%'.$this->product_cat_id.'%')->orderBy('created_at', 'DESC')->paginate($this->pageSize);
        } else if($this->sorting == 'price'){
            $products = Producto::where('name','like','%'. $this->search .'%')->where('category_id','like', '%'.$this->product_cat_id.'%')->orderBy('regular_price', 'ASC')->paginate($this->pageSize);
        } else if($this->sorting == 'price-desc'){
            $products = Producto::where('name','like','%'. $this->search .'%')->where('category_id','like', '%'.$this->product_cat_id.'%')->orderBy('regular_price', 'DESC')->paginate($this->pageSize);
        }else {
            $products = Producto::where('name','like','%'. $this->search .'%')->where('category_id','like', '%'.$this->product_cat_id.'%')->paginate($this->pageSize);
        }

        $categories = Category::all();
        $popular_products = Producto::inRandomOrder()->limit(4)->get();

        return view('livewire.search-component', [
            'products' => $products,
            'categories'=>$categories,
            'popular_products' => $popular_products
        ])->layout('layouts.base');
    }

}
