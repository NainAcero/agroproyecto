<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Discount;
use Cart;

class CartComponent extends Component
{
    public $total;

    public function mount(){
        $this->total = Cart::total();
    }

    public function increaseQuantity($rowId){
        $product = Cart::get($rowId);
        $qty = $product->qty + 1;
        Cart::update($rowId, $qty);
        $this->total = Cart::total();
    }

    public function decreaseQuantity($rowId){
        $product = Cart::get($rowId);
        $qty = $product->qty - 1;
        Cart::update($rowId, $qty);
        $this->total = Cart::total();
    }

    public function destroy($rowId){

        Cart::remove($rowId);
        $this->total = Cart::total();
        session()->flash('success_message', 'Item has been removed');
    }

    public function destroyAll(){
        Cart::destroy();
        $this->total = Cart::total();
        session()->flash('success_message', 'All items have been removed');
    }

    public function code_discount($value){
        $discount = Discount::where('ticket', $value)->first();
        $this->total = ($discount->type == "money")?
            $this->total - $discount->discount:
            $this->total - $this->total * $discount->discount / 100;
        session()->flash('success_message', 'A discount has been applied');
    }

    public function render()
    {
        $popular_products = Producto::orderBy('created_at', 'DESC')->limit(8)->get();
        return view('livewire.cart-component', [
            'popular_products' => $popular_products,
            'total' => $this->total
        ])->layout('layouts.base');
    }
}
