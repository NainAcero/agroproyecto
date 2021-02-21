<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Historial;
use Cart;

class UserDashboardComponent extends Component
{
    public function render()
    {
        $historial = Historial::whereDate('created_at', '=', date('Y-m-d'))
            ->where('usado','0')->first();

        $total = Cart::total();
        $desc = Cart::total();

        if($historial != null){
            if($historial->type == "money"){
                $desc = number_formt($total)  - (double)$historial->descuento;
            }else{
                $desc = number_formt($total) - number_formt($total)*(double)($historial->descuento / 100);
            }
        }
        // $historial->usado = 1;
        // $historial->save();
        return view('livewire.user.user-dashboard-component', [
            "total" => $total,
            "desc" => $desc
        ])->layout('layouts.base');
    }
}

function number_formt($number){
    return (double)floatval(str_replace(',','',$number));
}
