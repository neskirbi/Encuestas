<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Cliente;
use App\Models\Generador;
use App\Models\Entidad;
use App\Models\Token;
use Redirect;

class GeneradorController extends Controller
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
        $entidades=Entidad::All();
        return view('administracion.generadores.create',['entidades'=>$entidades]);
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
       
        

        $cliente = Cliente::where([
            'mail' => $request->correo
        ])->first();
        
        if($cliente){
            return Redirect::back()->with('error', 'Error al registrar, el correo ya se ha registrado anteriormente.');
        }
        
        $cliente=new Cliente();
        $id = $cliente->id = GetUuid();
        $cliente->nombres=$request->nombres;
        $cliente->apellidos=$request->apellidos;
        $mail = $cliente->mail=$request->correo;
        $cliente->pass=password_hash('',PASSWORD_DEFAULT);
        $cliente->accept= 1;
        $cliente->confirmacion= 1;
        if(!$cliente->save()){
            
            return Redirect::back()->with('error', 'Error al crear el registro.');
        }




        $generador=new Generador();
        $generador->id=GetUuid();
        $generador->id_cliente=$id;

        $generador->razonsocial = $request->razonsocial;
        $generador->fisicaomoral = $request->fisicaomoral;
        $generador->rfc = $request->rfc;

        $generador->rfcpdf = $generador->id.'.pdf';

        if(!GuardarArchivos($request->rfcpdf,'/documentos/generadores/rfc/empresa',$generador->rfcpdf)){
            return Redirect::back()->with('error', 'Error al guardar RFC del generador.');
        }

        $generador->calle = $request->calle;
        $generador->numeroext = $request->numeroext;
        $generador->numeroint = $request->numeroint;
        $generador->colonia = $request->colonia;
        $generador->entidad = $request->entidad;
        $generador->municipio = $request->municipio;
        $generador->cp = $request->cp;
        $generador->telefono = $request->telefono;
        $generador->celular = $request->celular;
        $generador->mail = $request->mail;
        $generador->mail2 = $request->mail2;

        if($request->fisicaomoral=="Moral"){

            /**
             * Representante Persona Moral
             */
            $generador->nombresrepre = $request->nombresrepre;
            $generador->apellidosrepre = $request->apellidosrepre;
            $generador->nacionalidadrepre = $request->nacionalidadrepre;
            $generador->identificacionrepre = $request->identificacionrepre;

            $generador->identificacionreprepdf = $generador->id.'.pdf';

            if(!GuardarArchivos($request->identificacionreprepdf,'/documentos/generadores/identificaciones/representante',$generador->identificacionreprepdf)){
                return Redirect::back()->with('error', 'Error al guardar RFC del generador.');
            }
            
            $generador->rfcrepre = $request->rfcrepre;

            $generador->rfcreprepdf = $generador->id.'.pdf';

            if(!GuardarArchivos($request->rfcreprepdf,'/documentos/generadores/rfc/representante', $generador->rfcreprepdf)){
                return Redirect::back()->with('error', 'Error al guardar RFC del generador.');
            }
            
            /**
             * Empresa Persona Moral
             */
            $generador->fechaconst = $request->fechaconst;
            $generador->numeroactacont = $request->numeroactacont;

            $generador->numeroactacontpdf = $generador->id.'.pdf';

            if(!GuardarArchivos($request->numeroactacontpdf,'/documentos/generadores/actas/empresa',$generador->numeroactacontpdf)){
                return Redirect::back()->with('error', 'Error al guardar RFC del generador.');
            }
            

            if(!GuardarArchivos($request->podernotarial,'/documentos/generadores/actas/poder',$generador->id.'.pdf')){
                return Redirect::back()->with('error', 'Error al guardar el poder notarial del generador.');
            }


            $generador->domicilioempresapdf = $generador->id.'.pdf';

            if(!GuardarArchivos($request->domicilioempresapdf,'/documentos/generadores/comprobantedomicilio/empresa',$generador->domicilioempresapdf)){
                return Redirect::back()->with('error', 'Error al guardar Comprobante de domicilio de la empresa.');
            }

            $generador->notario = $request->notario;
            //$generador->numeronotario = $request->numeronotario;
            $generador->numeronotaria = $request->numeronotaria;
            $generador->entidadnotaria = $request->entidadnotaria;

            
        }

        if($request->fisicaomoral=="Física"){
            /**
             * Datos Persona Fisica
             */
            $generador->nombresfisica = $request->nombresfisica;
            $generador->apellidosfisica = $request->apellidosfisica;
            $generador->nacionalidadfisica = $request->nacionalidadfisica;
            $generador->identificacionfisica = $request->identificacionfisica;

            $generador->identificacionfisicapdf = $generador->id.'.pdf';

            if(!GuardarArchivos($request->identificacionfisicapdf,'/documentos/generadores/identificaciones/personafisica',$generador->identificacionfisicapdf)){
                return Redirect::back()->with('error', 'Error al guardar RFC del generador.');
            }
        
        }

        if($generador->save()){
            $token=new Token();        
            $token->id=$id;
            $token->token=password_hash($id,PASSWORD_DEFAULT);
            $token->mail=$request->correo;
            $token->save();
            Notificar('Generar Contraseña','Generar contraseña.','','Por favor, para generar la contraseña en la plataforma Reci-Track de la cuenta '.$request->correo.' de click en el siguiente enlace.',[$request->correo],'<a href="https://reci-track.mx/AdminPass/'.$id.'" class="btn btn-default  btn-outline-secondary">Generar Contraseña</a>');
            Notificar('Nuevo Generador','Nuevo Generador Registrado.','Verificar datos del generador','Se ha registrado la información del generador '.$request->razonsocial.' para la validación de los datos.',['cesar@csmx.mx'],'<a href="https://reci-track.mx/acceso" class="btn btn-default  btn-outline-secondary">Ir a Recitrack</a>');
            return redirect('generadores')->with('success', 'Registro correcto.');
            
        }else{
            return redirect('establecimientos')->with('error', 'Error al crear el registro.');
            
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
