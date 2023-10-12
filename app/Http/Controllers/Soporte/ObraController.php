<?php

namespace App\Http\Controllers\Soporte;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Obra;
use App\Models\Entidad;
use App\Models\Municipio;
use Redirect;

class ObraController extends Controller
{
    function index(Request $filtros){
        $where="obras.id != ''";
        if(isset($filtros->publica) || isset($filtros->privada)){ 

            if(isset($filtros->publica) && !isset($filtros->privada)){
                $where="obras.publica = 1";
            }

            if(!isset($filtros->publica) && isset($filtros->privada)){
                $where="obras.publica = 0";
            }

        }
        //return $where;
        $obras = DB::table('generadores')
        ->join('obras', 'obras.id_generador', '=', 'generadores.id')
        ->where('obras.obra','like','%'.$filtros->obra.'%')
        ->where('generadores.razonsocial','like','%'.$filtros->generador.'%')
        ->whereraw($where)        
        ->select(DB::RAW("(SELECT concat(nombres,' ',apellidos) from clientes where id=generadores.id_cliente) as cliente "),'obras.id','obras.obra','obras.tipoobra','obras.nautorizacion','generadores.razonsocial','obras.publica',
        'obras.verificado','obras.transporte','obras.puedepospago','obras.created_at')
        ->orderby('obras.created_at','desc')
        ->paginate(10);
       
        $tipoobras=array();

        return view('soporte.obras.obras',['obras'=>$obras,'tipoobras'=>$tipoobras,'filtros'=>$filtros]);
    }

    function show($id){
        $obra=Obra::find($id);
        $entidades=Entidad::orderby('entidad','asc')->get();
        $municipio=Municipio::find($obra->municipio);
        $entidad=array();
        if($municipio){            
            $entidad=Entidad::find($municipio->id_entidad);
        }

        
        return view('soporte.obras.show',['obra'=>$obra,'entidades'=>$entidades,'entidad'=>$entidad,'municipio'=>$municipio]);
    }


    function update(Request $request,$id){
        $obra=Obra::find($id);
        $obra->fechainicio=$request->fechainicio;
        $obra->fechafin=$request->fechafin;
        $obra->save();
        return Redirect::back()->with('success', 'Datos Guardados.');
    }
}
