<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Producto;
use Illuminate\Support\Str;
use Validator;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::skip(10)->take(5)->get();
        $categories = Category::all();
        return view('livewire.admin.producto', ["categories" => $categories, "productos" => $productos]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajax($skip)
    {
        $productos = DB::table('productos')
            ->select('categories.name as cname', 'productos.name as pname',
                'productos.image as pimagen', 'productos.regular_price as pprice',
                'productos.SKU as psdk', 'productos.id as pid'
            )
            ->join('categories',  'productos.category_id', '=' , 'categories.id')
            ->orderby('productos.created_at','DESC')
            ->skip($skip)
            ->take(10)
            ->get();
        $total = Producto::count();
        return response()->json(['data' => $productos->toArray(), "total" => $total], 201);
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
        if($request->id != null){
            $validator = Validator::make($request->all(), [
                'short_description' =>  'required|min:10',
                'description'       =>  'required|min:8',
                'regular_price'     =>  'required',
                'quantity'          =>  'required',
                'category_id'       =>  'required',
            ]);

            if ($validator->passes()) {
                $producto = Producto::where('id', $request->id)->first();
                $producto->description = $request->description;
                $producto->regular_price = $request->regular_price;
                $producto->short_description = $request->short_description;
                $producto->quantity = $request->quantity;
                $producto->category_id = $request->category_id;
                $producto->save();

                return response()->json(['data' => $producto->toArray()], 201);
            }

            return response()->json(['error'=>$validator->errors()->all()]);
        }
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
    public function show($sdk)
    {
        $producto = Producto::where('SKU', $sdk)->first();
        $categories = Category::all();
        return response()->json([
            'data' => $producto->toArray(),
            'categories' => $categories->toArray()
        ], 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::where('id', $id)->first();
        $categories = Category::all();
        return response()->json([
            'data' => $producto->toArray(),
            'categories' => $categories->toArray()
        ], 201);
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
        $producto = Producto::where('id', $id)->first();
        $producto->delete();
        return response()->json(['data' => $producto->toArray()], 201);
    }
}
