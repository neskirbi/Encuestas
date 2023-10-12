<?php

namespace App\Http\Controllers\Asociacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Generador;
use App\Models\Cliente;
use Redirect;

class GeneradorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $generadores = DB::table('generadores')
        ->where('borrado','1')
        ->where('generadores.razonsocial','like','%'.$request->generador.'%')
        ->orderby('created_at','desc')
        ->paginate(15);
        //return $generadores;
        
        return view('asociados.generadores.generadores',['filtros'=>$request,'generadores'=>$generadores]);
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
        $generador = Generador::find($id);
        return view('asociados.generadores.editgenerador',['generador'=>$generador]);
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
        //return $request;
        $generador=Generador::find($id);

        $generador->razonsocial = $request->razonsocial;
        //$generador->fisicaomoral = $request->fisicaomoral;
        $generador->rfc = $request->rfc;

        if(isset($request->rfcpdf)){
            $generador->rfcpdf=$generador->id.'.pdf';
            if(!GuardarArchivos($request->rfcpdf,'/documentos/generadores/rfc/empresa',$generador->rfcpdf)){
                return Redirect::back()->with('error', 'Error al guardar RFC del generador.');
            }
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

        if($generador->fisicaomoral=="Moral"){

            /**
             * Representante Persona Moral
             */
            $generador->nombresrepre = $request->nombresrepre;
            $generador->apellidosrepre = $request->apellidosrepre;
            $generador->nacionalidadrepre = $request->nacionalidadrepre;
            $generador->identificacionrepre = $request->identificacionrepre;

            if(isset($request->identificacionreprepdf)){
                $generador->identificacionreprepdf=$generador->id.'.pdf';
                if(!GuardarArchivos($request->identificacionreprepdf,'/documentos/generadores/identificaciones/representante',$generador->identificacionreprepdf)){
                    return Redirect::back()->with('error', 'Error al guardar RFC del generador.');
                }
            }
            
            $generador->rfcrepre = $request->rfcrepre;

            if(isset($request->rfcreprepdf)){
                $generador->rfcreprepdf=$generador->id.'.pdf';
                if(!GuardarArchivos($request->rfcreprepdf,'/documentos/generadores/rfc/representante',$generador->rfcreprepdf)){
                    return Redirect::back()->with('error', 'Error al guardar RFC del generador.');
                }
            }
            
            /**
             * Empresa Persona Moral
             */
            $generador->fechaconst = $request->fechaconst;
            $generador->numeroactacont = $request->numeroactacont;

             
            if(isset($request->numeroactacontpdf)){
                $generador->numeroactacontpdf=$generador->id.'.pdf';
                if(!GuardarArchivos($request->numeroactacontpdf,'/documentos/generadores/actas/empresa',$generador->numeroactacontpdf)){
                    return Redirect::back()->with('error', 'Error al guardar RFC del generador.');
                }
            }

            if(isset($request->podernotarial)){
                if(!GuardarArchivos($request->podernotarial,'/documentos/generadores/actas/poder',$generador->id.'.pdf')){
                    return Redirect::back()->with('error', 'Error al guardar el poder notarial del generador.');
                }
            }


            if(isset($request->domicilioempresapdf)){
                $generador->domicilioempresapdf=$generador->id.'.pdf';
                if(!GuardarArchivos($request->domicilioempresapdf,'/documentos/generadores/comprobantedomicilio/empresa',$generador->domicilioempresapdf)){
                    return Redirect::back()->with('error', 'Error al guardar RFC del generador.');
                }
            }

            $generador->notario = $request->notario;
            //$generador->numeronotario = $request->numeronotario;
            $generador->numeronotaria = $request->numeronotaria;
            $generador->entidadnotaria = $request->entidadnotaria;

            
        }

        if($generador->fisicaomoral=="Física"){
            /**
             * Datos Persona Fisica
             */
            $generador->nombresfisica = $request->nombresfisica;
            $generador->apellidosfisica = $request->apellidosfisica;
            $generador->nacionalidadfisica = $request->nacionalidadfisica;
            $generador->identificacionfisica = $request->identificacionfisica;

             
            if(isset($request->identificacionfisicapdf)){
                $generador->identificacionfisicapdf=$generador->id.'.pdf';
                if(!GuardarArchivos($request->identificacionfisicapdf,'/documentos/generadores/identificaciones/personafisica',$generador->identificacionfisicapdf)){
                    return Redirect::back()->with('error', 'Error al guardar RFC del generador.');
                }
            }
        
        }

        if($generador->save()){
            return Redirect::back()->with('success', 'Registro correcto.');
        }else{
            return Redirect::back()->with('error', 'Error al crear el registro.');
        }

        
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

    function ConfirmarGenerador($id){
        if(!Auth::guard('asociados')->check()){
            return Redirect::back()->with('error', 'No eres admin.');
        }

        $generador=Generador::find($id);
        $generador->verificado=1;
        if($generador->save()){
            $cliente=Cliente::find($generador->id_cliente);
            Notificar('Generador Confirmado','Generador Confirmado.','','Su información ha sido validada exitosamente, puede proceder a realizar el alta de su obra en el sistema.',[$cliente->mail],'<a href="https://reci-track.mx/" class="btn btn-default  btn-outline-secondary">Ir a Recitrack</a>');
            return Redirect::back()->with('success', 'Generador Confirmado.');
        }else{
            return Redirect::back()->with('error', 'Error al guardar.');
        }
    }
}
