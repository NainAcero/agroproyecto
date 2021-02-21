<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Producto;
use App\Models\User;

class AdminDashboardComponent extends Component
{
    public function render()
    {
        $productos = Producto::where('productos.quantity', '>', 0)->get();
        $usuarios = User::where('utype', 'USR')->get();

        return view('livewire.admin.admin-dashboard-component', [
            'productos' => $productos,
            'usuarios' => $usuarios
        ])->layout('layouts.base');
    }
}
