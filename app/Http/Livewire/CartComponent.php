<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Producto;
use Cart;

class CartComponent extends Component
{

    public function increaseQuantity($rowId){
        $product = Cart::get($rowId);
        $qty = $product->qty + 1;
        Cart::update($rowId, $qty);
    }

    public function decreaseQuantity($rowId){
        $product = Cart::get($rowId);
        $qty = $product->qty - 1;
        Cart::update($rowId, $qty);
    }

    public function destroy($rowId){
        Cart::remove($rowId);
        session()->flash('success_message', 'Item has been removed');
    }

    public function destroyAll(){
        Cart::destroy();
        session()->flash('success_message', 'All items have been removed');
    }

    public function render()
    {
        $popular_products = Producto::orderBy('created_at', 'DESC')->limit(8)->get();
        return view('livewire.cart-component', [
            'popular_products' => $popular_products
        ])->layout('layouts.base');
    }
}
