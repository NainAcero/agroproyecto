<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factura;
use App\Models\DetalleFactura;
use Illuminate\Support\Facades\Auth;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facturas = Factura::where('user_id',Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        return view('livewire.user.factura', ["facturas" => $facturas]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detallefacturas = DetalleFactura::where("factura_id", $id)->get();
        $factura = Factura::where("id", $id)->first();

        $desc = 0;
        if($factura->historial != null){
            if($factura->historial->type == "money"){
                $desc = number_formt($factura->total)  - (double)$factura->historial->descuento;
            }else{
                $desc = number_formt($factura->total) - number_formt($factura->total)*(double)($factura->historial->descuento / 100);
            }
        }

        return view('livewire.user.detallefactura', [
            "detallefacturas" => $detallefacturas,
            "factura" => $factura,
            "desc" => $desc
        ]);
    }
}

function number_formt($number){
    return (double)floatval(str_replace(',','',$number));
}
