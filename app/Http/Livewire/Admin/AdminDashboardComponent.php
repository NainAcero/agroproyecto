<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Factura;
use App\Models\User;

class AdminDashboardComponent extends Component
{
    public function render()
    {
        $facturas = Factura::orderBy('created_at', 'DESC')->get();
        $productos = Producto::where('productos.quantity', '>', 0)->get();
        $usuarios = User::where('utype', 'USR')->get();

        $total = 0;
        foreach($facturas as $factura){
            $total += number_formt($factura->total);
        }

        return view('livewire.admin.admin-dashboard-component', [
            'productos' => $productos,
            'usuarios' => $usuarios,
            'total' => $total,
            'facturas' => $facturas
        ])->layout('layouts.base');
    }
}


function number_formt($number){
    return (double)floatval(str_replace(',','',$number));
}
