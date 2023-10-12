<?php

namespace App\Http\Controllers\Asociacion;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Obra;
use App\Models\TipoObra;
use App\Models\Generador;
use App\Models\Chofer;
use App\Models\CategoriaMaterial;
use App\Models\Material;
use App\Models\MaterialObra;
use App\Models\Planta;
use Redirect;

class ObraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obras = DB::table('generadores')
        ->join('obras', 'obras.id_generador', '=', 'generadores.id')
        ->select('obras.id','obras.obra','obras.tipoobra','obras.nautorizacion','generadores.razonsocial','obras.verificado','obras.transporte','obras.created_at')
        ->orderby('obras.created_at','desc')
        ->get();
       
        $tipoobras=array();
        return view('asociados.obras.obras',['obras'=>$obras,'tipoobras'=>$tipoobras]);
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
       
        $obra=DB::table('generadores')
        ->join('obras','obras.id_generador','=','generadores.id')
        ->where('obras.id',$id)
        ->select('generadores.razonsocial','obras.id','obras.id_planta','obras.id_generador','obras.obra','obras.tipoobra','obras.subtipoobra','obras.cantidadobra','obras.calle','obras.numeroext','obras.numeroint','obras.colonia','obras.municipio','obras.entidad','obras.cp','obras.latitud','obras.longitud','obras.fechainicio','obras.fechafin','obras.superficie','obras.superunidades','obras.aplicaplan','obras.nautorizacion','obras.vigenciaplan','obras.declaratoria','obras.planmanejo','obras.telefono','obras.celular','obras.correo','obras.correo2','obras.verificado')
        ->first();

        $tag=DB::table('tipoobras')->where('tipoobra',$obra->tipoobra)->first();

        $materiales=DB::table('obras')
        ->join('materialesobra','materialesobra.id_obra','=','obras.id')
        ->where('obras.id',$id)
        ->where('materialesobra.cantidad','!=',0)
        ->select('materialesobra.id_material','materialesobra.categoriamaterial','materialesobra.material','materialesobra.cantidad','materialesobra.unidades','materialesobra.precio')
        ->orderby('materialesobra.categoriamaterial','asc')
        ->orderby('materialesobra.material','asc')
        ->get();
        
        
        $tipoobras=TipoObra::select('tipoobra','tag')->distinct()->get();
        $subtipoobras=TipoObra::all();
         
        $categorias=CategoriaMaterial::all();
        $planta=Planta::find($obra->id_planta);        
        $plantas=Planta::all();
        

        return view('asociados.obras.obra',['obra'=>$obra,'materiales'=>$materiales,'tipoobras'=>$tipoobras,'subtipoobras'=>$subtipoobras,
        'categorias'=>$categorias,'materiales'=>$materiales,'tag'=>(isset($tag->tag) ? $tag->tag : 'Cantidad'),'planta'=>$planta,'plantas'=>$plantas]);
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

        
        $obra=Obra::find($id);        

        $obra->obra=$request->obra;
        
        
        $obra->tipoobra=$request->tipoobra;
      
        $obra->subtipoobra=$request->subtipoobra;
        $obra->cantidadobra=$request->cantidadobra;
        $obra->calle=$request->calle;
        $obra->numeroext=$request->numeroext;
        $obra->numeroint=$request->numeroint;
        $obra->colonia=$request->colonia;
        $obra->municipio=$request->municipio;
        $obra->entidad=$request->entidad;
        $obra->cp=$request->cp;
        $obra->latitud=$request->latitud;
        $obra->longitud=$request->longitud;
        $obra->fechainicio=$request->fechainicio;
        $obra->fechafin=$request->fechafin;
        
        
        $obra->telefono=$request->telefono;
        $obra->celular=$request->celular;
        $obra->correo=$request->correo;
        $obra->correo2=$request->correo2;

        

        if($request->aplicaplan=='on'){
            $obra->aplicaplan=true;
        }else{
            $obra->aplicaplan=false;
        }
        
        

        $materialesobra = DB::table('materialesobra')
        ->where('id_obra',$id)
        ->get();
        


        $obra->superficie=$request->superficie;
        $obra->superunidades=$request->superunidades;
        $acumulado="";

        for($i=0;$i<count($materialesobra);$i++){
            $material=MaterialObra::find($materialesobra[$i]->id);            
            $material->cantidad=0;
            foreach($request->material as $index => $mate)
            {
                if($mate==$material->id_material)
                {                    
                    $material->cantidad=$request->cantidad[$index];
                    $material->precio=$request->precio[$index];
                    break;
                }
            }
            
            if(!$material->save()){
                return Redirect::back()->with('error', 'Error al guardar los materiales.');
            }
        }

        if($obra->save()){
            return Redirect::back()->with('success', 'Datos guardados.');
        }else{
            return Redirect::back()->with('error', 'Error al guardar los datos.');
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
