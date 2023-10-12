<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmacionMail;
use App\Models\Cliente;
use Redirect;
class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           
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
        //return $request;
        if(strlen($request->mail)==0 || strlen($request->pass)==0 || strlen($request->nombres)==0 || strlen($request->apellidos)==0){
            return redirect('home')->with('error', '¡Datos incorrectos!');
        }


        if($request->pass!=$request->pass2){
            return Redirect::back()->with('error', 'Error al crear el registro, las contraseñas no coinciden.');
        }
          
        
        $cliente = Cliente::where([
            'mail' => $request->mail
        ])->first();
        
        if($cliente)
        {
            return Redirect::back()->with('error', 'Error al registrar, el correo ya se ha registrado anteriormente.');
        }
        
        $cliente=new Cliente();
        $id = $cliente->id = GetUuid();
        $cliente->nombres=$request->nombres;
        $cliente->apellidos=$request->apellidos;
        $mail = $cliente->mail=$request->mail;
        $cliente->pass=password_hash($request->pass,PASSWORD_DEFAULT);
        $cliente->accept= $request->accept=='on' ? 1 : 0;
        if($cliente->save()){
            return view('mails.enviodecorreo',['cliente'=>$cliente]);
        }else{
            return Redirect::back()->with('error', 'Error al crear el registro.');
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
