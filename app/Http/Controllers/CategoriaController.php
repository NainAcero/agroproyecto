<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Validator;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('livewire.admin.categoria', ["categories" => $categories]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajax($skip)
    {
        // $categories = DB::table('categories')
        // ->join('productos', 'productos.category_id', '=', 'categories.id')
        // ->select('categories.id', 'categories.name', 'categories.slug', DB::raw("count(*) as count"))
        // ->skip($skip)->take(5)
        // ->orderby('categories.created_at','DESC')
        // ->groupBy('categories.id', 'categories.name', 'categories.slug')
        // ->get();

        $categories = Category::orderby('created_at','DESC')->skip($skip)->take(5)->get();
        $total = Category::count();
        return response()->json(['data' => $categories->toArray(), "total" => $total], 201);
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
        $validator = Validator::make($request->all(), [
            'name*' =>  'required|min:8|array|unique:categories',
        ]);

        if ($validator->passes()) {

            $categories = [];
            if($request->id == null){
                for($i =0 ; $i < count($request->name); $i++){
                    $category = Category::create([
                        'name' => $request->name[$i],
                        'slug' => Str::slug($request->name[$i]),
                    ]);
                    $categories[] = $category;
                }

            }else{
                $category = Category::where('id', $request->id)->first();
                $category->name = $request->name[0];
                $category->slug = Str::slug($request->name[0]);
                $category->save();
                $categories[] = $category;
            }
            return response()->json(['data' => $categories ], 201);

        }

    	return response()->json(['error'=>$validator->errors()->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nombre)
    {
        $category = DB::table('categories')->where('name', 'like', '%'. $nombre .'%')->first();
        return response()->json([
            'data' => $category
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $nombre
     * @return \Illuminate\Http\Response
     */
    public function all($nombre)
    {
        $categories = DB::table('categories')->where('name', 'like', '%'. $nombre .'%')->get();
        return response()->json([
            'data' => $categories
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
        $category = Category::where('id', $id)->first();
        return response()->json([
            'data' => $category->toArray()
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
        $category = Category::where('id', $id)->first();
        $category->delete();
        return response()->json(['data' => $category->toArray()], 201);
    }
}
