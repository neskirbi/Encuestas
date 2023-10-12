<?php

namespace App\Http\Controllers\Cliente;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Generador;
use Redirect;

class GeneradoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('clientelogged');
    }

    
    public function index()
    {
        $generadores = DB::table('generadores')
        ->where('id_cliente',Auth::guard('clientes')->user()->id)
        ->where('borrado','1')        
        ->orderby('created_at','desc')
        ->get();
        //return $generadores;
        
        return view('cliente.generadores.generadores',['generadores'=>$generadores]);
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
        $generador=new Generador();
        $generador->id=GetUuid();
        $generador->id_cliente=Auth::guard('clientes')->user()->id;

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
            Notificar('Nuevo Generador','Nuevo Generador Registrado.','Verificar datos del generador','Se ha registrado la información del generador '.$generador->razonsocial.' para la validación de los datos.',['emiliano@csmx.mx'],'<a href="https://reci-track.mx/acceso" class="btn btn-default  btn-outline-secondary">Ir a Recitrack</a>');
            return redirect('generadores')->with('success', 'Registro correcto.');
        }else{
            return redirect('generadores')->with('error', 'Error al crear el registro.');
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
        $generador = Generador::find($id);
        return view('cliente.generadores.generador',['generador'=>$generador]);
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
    public function destroy($id){
        $generador=Generador::find($id);
        if($generador->verificado==1){
            return redirect('generadores')->with('error', 'Error: No se puede borrar un generador verificado.');           
        }else{
            $generador->borrado=0;

            if($generador->save()){
                return redirect('generadores')->with('success', 'Generador borrado.');
            }else{
                return redirect('generadores')->with('error', 'Error al eliminar registro.');
            }
        }
        
    }

    /**
     * Notificacion por correo de la alta del Generador
     */

    
}
