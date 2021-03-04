<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;

class DiscontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = Discount::orderBy('created_at', 'DESC')->get();
        return view('livewire.admin.discont.index', ["discounts" => $discounts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('livewire.admin.discont.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'ticket'         =>  'required',
            'quantity'       =>  'required',
            'discount'       =>  'required',
            'type'           =>  'required',
            'fin_date'       =>  'required'
        ];
        $this->validate($request, $rules);

        $discount = Discount::create([
            'ticket' => $request->ticket,
            'quantity' => $request->quantity,
            'discount' => $request->discount,
            'type' => $request->type,
            'fin_date' => $request->fin_date,
        ]);

        $notification = 'El descuento se creo correctamente.';
        return redirect('/admin/descuento')->with(compact('notification'));
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
        $discount = Discount::where('id', $id)->first();
        return view('livewire.admin.discont.update', ["discount" => $discount]);
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
        $rules = [
            'ticket'         =>  'required',
            'quantity'       =>  'required',
            'discount'       =>  'required',
            'type'           =>  'required',
            'fin_date'       =>  'required'
        ];
        $this->validate($request, $rules);

        $discount = Discount::where('id', $id)->first();
        $discount->ticket = $request->ticket;
        $discount->quantity = $request->quantity;
        $discount->discount = $request->discount;
        $discount->type = $request->type;
        $discount->fin_date = $request->fin_date;
        $discount->save();

        $notification = 'El descuento se actualizó correctamente.';
        return redirect('/admin/descuento')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $discount = Discount::where('id', $id)->first();
        $discount->delete();

        $notification = 'El descuento se elimino correctamente.';
        return redirect('/admin/descuento')->with(compact('notification'));
    }
}
