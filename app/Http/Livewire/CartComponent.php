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
        if($discount != null){
            if($discount->quantity > 0){
                $this->total = ($discount->type == "money")?
                    number_formt($this->total)  - (double)$discount->discount:
                    number_formt($this->total) - number_formt($this->total)*(double)($discount->discount / 100);
                session()->flash('success_message', 'A discount has been applied');
                $discount->quantity = $discount->quantity - 1;
                $discount->save();
            }else{
                session()->flash('error_message', 'Cupon agotado');
            }

        }else{
            session()->flash('error_message', 'Cupon no válido');
        }
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


function number_formt($number){
    return (double)floatval(str_replace(',','',$number));
}
