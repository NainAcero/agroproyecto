<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Producto;
use Illuminate\Support\Str;
use Validator;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('livewire.admin.producto', ["categories" => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'              =>  'required|min:8|unique:productos',
            'short_description' =>  'required|min:10',
            'description'       =>  'required|min:8',
            'regular_price'     =>  'required',
            'quantity'          =>  'required',
            'category_id'       =>  'required',
            'SKU'               =>  'required|min:6|unique:productos',
        ]);

        if ($validator->passes()) {

            $producto =  Producto::create(
                $request->only('SKU', 'name', 'short_description', 'description', 'regular_price', 'quantity', 'category_id')
                + [
                    'slug'      =>  Str::slug($request->name),
                    'stock_status'  =>  'instock'
                ]
            );

            return response()->json(['data' => $producto->toArray()], 201);
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
    public function edit($id)
    {
        //
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
        //
    }
}
