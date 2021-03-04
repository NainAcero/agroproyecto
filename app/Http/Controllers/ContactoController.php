<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacto;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class ContactoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $details = [
        //     'title' => 'Correo ',
        //     'body' => 'adwa'
        // ];
        // Mail::to("a_nacerom@unjbg.edu.pe")->send(new TestMail($details));
        $mensajes = Contacto::whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))->orderBy('created_at', 'DESC')->get();
        return view('livewire.admin.mensaje', ["mensajes" => $mensajes]);
    }

    public function show($id){
        $contacto = Contacto::where('id', $id)->first();
        return view('livewire.admin.mensajeShow', ["contacto" => $contacto]);
    }

    public function gmail(Request $request){
        $rules = [
            'titulo'            =>  'required',
            'descripcion'       =>  'required',
            'email'             =>  'required',
        ];
        $this->validate($request, $rules);
        $details = [
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'email' => $request->email
        ];
        Mail::to($request->email)->send(new TestMail($details));
        $notification = 'El mensaje se envió correctamente.';
        return redirect('/contacto')->with(compact('notification'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function enviar(Request $request)
    {
        $rules = [
            'name'           =>  'required|',
            'email'          =>  'required|min:5',
            'telefono'       =>  'required|min:8',
            'comentario'     =>  'required',
        ];
        $this->validate($request, $rules);

        $contacto = Contacto::create([
            'name' => $request->name,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'comentario' => $request->comentario
        ]);

        $notification = 'El mensaje se envió correctamente.';
        return redirect('/contact')->with(compact('notification'));
    }

}
