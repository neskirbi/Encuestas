<?php

namespace App\Http\Controllers\Transportista;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transportista;

class TransportistaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $transportista=Transportista::where('mail',$request->mail)->first(); 
        if($transportista){            
            return redirect('home')->with('error', 'Error, este correo ya registrado.');
        }   

        if($request->pass!= $request->pass2 ){
            return Redirect::back()->with('error', 'Registro no exitoso');
        }
        $transportista = new Transportista();
        $transportista->id = GetUuid();
        $transportista->transportista = $request->transportista;
        $transportista->mail = $request->mail;
        $transportista->pass = password_hash($request->pass,PASSWORD_DEFAULT);
        if($transportista->save()){
            Notificar('Confirmación de Correo','Verificar su dirección de correo para finalizar su registro.','Gracias por elegir Reci-track.','Por favor confirme que '.$transportista->mail.' es su correo dando click en el siguiente enlace.',$transportista->mail,'<a href="https://reci-track.mx/confirmaciont/'.$transportista->id.'">Confirmar Correo</a>');
            return redirect(url('home'))->with('success', 'Registro de empresa exitoso');
        }else{
            return Redirect::back();
        }

      
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
