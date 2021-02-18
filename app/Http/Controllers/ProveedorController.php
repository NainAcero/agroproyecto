<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use Validator;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedors = Proveedor::all();
        return view('livewire.admin.proveedor', ["proveedors" => $proveedors]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajax($skip)
    {
        $proveedors = Proveedor::orderby('created_at','DESC')->skip($skip)->take(5)->get();
        $total = Proveedor::count();
        return response()->json(['data' => $proveedors->toArray(), "total" => $total], 201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->id != null){
            $validator = Validator::make($request->all(), [
                'nombre'       =>  'required|min:10',
                'adress'       =>  'required|min:8',
                'telefono'     =>  'required'
            ]);

            if ($validator->passes()) {
                $proveedor = Proveedor::where('id', $request->id)->first();
                $proveedor->nombre = $request->nombre;
                $proveedor->adress = $request->adress;
                $proveedor->telefono = $request->telefono;
                $proveedor->save();

                return response()->json(['data' => $proveedor->toArray()], 201);
            }

            return response()->json(['error'=>$validator->errors()->all()]);
        }

        $validator = Validator::make($request->all(), [
            'ruc'          =>  'required|min:8|unique:proveedors',
            'nombre'       =>  'required|min:10',
            'adress'       =>  'required|min:8',
            'telefono'     =>  'required'
        ]);

        if ($validator->passes()) {

            $proveedor =  Proveedor::create(
                $request->only('ruc', 'nombre', 'adress', 'telefono')
            );

            return response()->json(['data' => $proveedor->toArray()], 201);
        }

    	return response()->json(['error'=>$validator->errors()->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ruc)
    {
        $proveedor = Proveedor::where('ruc', $ruc)->first();
        return response()->json(['data' => $proveedor->toArray()], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proveedor = Proveedor::where('ruc', $id)->first();
        $proveedor->delete();
        return response()->json(['data' => $proveedor->toArray()], 201);
    }
}
