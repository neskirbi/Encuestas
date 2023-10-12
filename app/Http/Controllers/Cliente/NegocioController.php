<?php

namespace App\Http\Controllers\Cliente;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Negocio;
use App\Models\TipoNegocio;
use App\Models\Planta;
use App\Models\Entidad;
use App\Models\Generador;
use App\Models\Configuracion;

use Redirect;


class NegocioController extends Controller
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
        

        $negocios = DB::table('negocios')
        ->join('generadores', 'generadores.id', '=', 'negocios.id_generador')
        ->where('generadores.id_cliente',Auth::guard('clientes')->user()->id)
        ->select('negocios.id','negocios.negocio','negocios.tiponegocio','generadores.razonsocial','negocios.verificado')
        ->orderby('negocios.created_at','desc')
        ->get();

        

        return view('cliente.negocios.negocios',['negocios'=>$negocios]);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plantas=Planta::where('tipo',2)->get();
        $tiponegocios=TipoNegocio::All();        
        $entidades=Entidad::All();
        $generadores=Generador::where('id_cliente','=',Auth::guard('clientes')->user()->id)->get();
        return view('cliente.negocios.create',['generadores'=>$generadores,'plantas'=>$plantas,'tiponegocios'=>$tiponegocios,'entidades'=>$entidades]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $negocio = new Negocio();

        $negocio->id=GetUuid();        
        $negocio->id_generador=$request->generador;
        $negocio->id_planta=$request->planta;

        $negocio->negocio=$request->negocio;
        
        $tiponegocio=TipoNegocio::where('id','=',$request->tiponegocio)->first();
        if(!$tiponegocio){
            return Redirect::back()->with('error', 'El tipo de negocio no se encuentra');
        }
        $negocio->tiponegocio=$tiponegocio->tiponegocio;


        $negocio->calle=$request->calle;
        $negocio->numeroext=$request->numeroext;
        $negocio->numeroint=$request->numeroint;
        $negocio->colonia=$request->colonia;
        $negocio->municipio=$request->municipio;
        $negocio->entidad=$request->entidad;
        $negocio->cp=$request->cp;
        $negocio->latitud=$request->latitud;
        $negocio->longitud=$request->longitud;
        $negocio->fechainicio=$request->fechainicio;
        $negocio->fechafin=$request->fechafin;
        
        //Subir plan de manejo
        $nombre = $negocio->id.'.pdf';
        if(!GuardarArchivos($request->plan,'/documentos/clientes/negocios/plan',$nombre)){
            return Redirect::back()->with('error', 'Error al guardar RFC del generador.');
        }

        $negocio->telefono=$request->telefono;
        $negocio->celular=$request->celular;
        $negocio->correo=$request->correo;

        $confi=Configuracion::select('iva')->where('id_planta',$request->planta)->first();
        $negocio->iva=$confi->iva;
        

        if($negocio->save()){
            return redirect('negocios')->with('success', 'Datos guardados.');
        }else{
            return redirect('negocios')->with('error', 'Error al guardar los datos.');
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
        
        $negocio=Negocio::find($id);

        $generador=DB::table('generadores')
        ->where('generadores.id',$negocio->id_generador)
        ->first();

        $planta=DB::table('plantas')
        ->where('plantas.id',$negocio->id_planta)
        ->first();

        $entidad=DB::table('entidades')
        ->where('id',$negocio->entidad)
        ->first();


        
        return view('cliente.negocios.negocio',['negocio'=>$negocio,'generador'=>$generador,'planta'=>$planta,'entidad'=>$entidad]);


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
        $negocio=Negocio::find($id);
        
        if($negocio->delete()){
            return redirect('negocios')->with('success', 'Se eliminó el registro.');
        }else{
            return redirect('negocios')->with('error', 'Error al eliminar.');
        }
    }


    public function RegistroNegocio(){
        $generadores = Generador::all()
        ->where('id_cliente',Auth::guard('clientes')->user()->id)
        ->where('borrado','1')
        ->where('verificado','1');
        
        
        $configuraciones=DB::table('configuraciones')->first();
      

        $tiponegocio=TipoNegocio::select('tiponegocio','tag')->distinct()->get();
        $subtiponegocio=TipoNegocio::all();
        
        
        $plantas=Planta::all();
        return view('cliente.negocios.registronegocios',['generadores'=>$generadores,'tiponegocios'=>$tiponegocios,'subtiponegocios'=>$subtiponegocios,'plantas'=>$plantas]);
    }


    function Cedula($id){
        $negocio=Negocio::find($id);
        $url=GeneraQR('images/qr/cedula/',str_replace('/','-',$negocio->negocio).'/'.$id);
        return view('formatos.cedulas.cedula',['negocio'=>$negocio,'url'=>$url]);
    }

}
