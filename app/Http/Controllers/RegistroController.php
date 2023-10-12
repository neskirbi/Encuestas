<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Transportista;
use Redirect;

class RegistroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Registro(Request $request)
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

        $transportista = Transportista::where([
            'mail' => $request->mail
        ])->first();
        
        if($transportista)
        {
            return Redirect::back()->with('error', 'Error al registrar, el correo ya se ha registrado anteriormente.');
        }


        switch($request->usuario){
            case 1:

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

            break;

            case 2:

                $transportista = new Transportista();
                $transportista->id = GetUuid();
                $transportista->transportista = $request->nombres.' '.$request->apellidos;
                $transportista->mail = $request->mail;
                $transportista->pass = password_hash($request->pass,PASSWORD_DEFAULT);
                if($transportista->save()){
                    Notificar('Confirmación de Correo','Verificar su dirección de correo para finalizar su registro.','Gracias por elegir Reci-track.','Por favor confirme que '.$transportista->mail.' es su correo dando click en el siguiente enlace.',$transportista->mail,'<a href="https://reci-track.mx/confirmaciont/'.$transportista->id.'">Confirmar Correo</a>');
                    return redirect(url('home'))->with('success', 'Registro de empresa exitoso');
                }else{
                    return Redirect::back();
                }
            break;

        }
        
        
        
    }

   
}
