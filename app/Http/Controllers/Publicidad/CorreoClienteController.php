<?php

namespace App\Http\Controllers\Publicidad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Banner;

class CorreoClienteController extends Controller
{
    public function __construct(){
        $this->middleware('publicidadeslogged');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bannercorreo=Banner::where('tipo',2)->orderby('created_at' , 'desc')->first();
        return view('publicidad.correocliente.correoscliente',['bannercorreo'=>$bannercorreo]);
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
        //
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

    function CargarClienteCorreo(Request $request){
        

        $banner=new Banner();
        $id=GetUuid();

        

        $banner->id=$id;
        $banner->tipo=2;
        $banner->tiponombre='clientes';
        $banner->nombre='';
        $banner->enlace='';
        $banner->mail=$request->mail;
        $banner->save();
        

        return redirect('CorreoClientes')->with('success','Se generó el correo.');
    }

    function ProbarCorreoCliente(Request $request){
        $bannercorreo=Banner::where('tipo',2)->orderby('created_at' , 'desc')->first();
        $bannercorreo->mail=ReemplazarTags($bannercorreo->mail,Cliente::first());
        MandarCorreo('Registro en Recitrack','Registro en Recitrack',$bannercorreo->mail,[$request->mail],'<a href="http://reci-track.mx/confirmacion/191f5d282f2a439c9fc7283c0cda42b8"><img width="300px" src="'.asset('images/botones').'/confirmar.png"></a>');
        return redirect('CorreoClientes')->with('success','Se envio el correo.');
    }
}
