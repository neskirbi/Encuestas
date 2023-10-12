<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Negocio;
use App\Models\TipoNegocio;
use App\Models\Entidad;
use App\Models\Planta;
use App\Models\Configuracion;
use Redirect;

class NegocioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $negocios = DB::table('negocios')
        ->join('generadores', 'generadores.id', '=', 'negocios.id_generador')
        ->where('negocios.id_planta',GetIdPlanta())
        ->select('negocios.id','negocios.negocio','negocios.tiponegocio','generadores.razonsocial','negocios.verificado')
        ->orderby('negocios.created_at','desc')
        ->get();

        return view('administracion.negocios.negocios',['negocios'=>$negocios]);
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
        $generadores=Generador::all();
        return view('administracion.negocios.create',['generadores'=>$generadores,'plantas'=>$plantas,'tiponegocios'=>$tiponegocios,'entidades'=>$entidades]);
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
        $negocio=Negocio::find($id);

        $tiponegocios=TipoNegocio::all();

        $entidades=Entidad::all();
        $plantas=Planta::all();

        $generador=DB::table('generadores')
        ->where('generadores.id',$negocio->id_generador)
        ->first();

        $planta=DB::table('plantas')
        ->where('plantas.id',$negocio->id_planta)
        ->first();

        $entidad=DB::table('entidades')
        ->where('id',$negocio->entidad)
        ->first();


        
        return view('administracion.negocios.negocio',['negocio'=>$negocio,'generador'=>$generador,'planta'=>$planta,'plantas'=>$plantas,'entidades'=>$entidades,'entidad'=>$entidad,'tiponegocios'=>$tiponegocios]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
    }
  
    
    public function update(Request $request, $id)
    {
        //return $request;

        //negocio->id=GetUuid(); 
        $negocio=Negocio::find($id);      
        $negocio->id_planta=$request->planta;

        $negocio->negocio=$request->negocio;
        
        if(strlen($request->tiponegocio)==32){
            $tiponegocio=TipoNegocio::where('id','=',$request->tiponegocio)->first();
            if(!$tiponegocio){
                return Redirect::back()->with('error', 'El tipo de negocio no se encuentra');
            }
            $negocio->tiponegocio=$tiponegocio->tiponegocio;

        }
        

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
        $negocio->verificado=1;
        
        //Subir plan de manejo
        if($request->plan!=null){
            $nombre = $negocio->id.'.pdf';
            if(!GuardarArchivos($request->plan,'/documentos/clientes/negocios/plan',$nombre)){
                return Redirect::back()->with('error', 'Error al guardar RFC del generador.');
            }
        }
       

        $negocio->telefono=$request->telefono;
        $negocio->celular=$request->celular;
        $negocio->correo=$request->correo;

        $confi=Configuracion::select('iva')->where('id_planta',$request->planta)->first();
        $negocio->iva=$confi->iva;
        

        if($negocio->save()){
            return redirect('establecimientos')->with('success', 'Datos guardados.');
        }else{
            return redirect('establecimientos')->with('error', 'Error al guardar los datos.');
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
}
