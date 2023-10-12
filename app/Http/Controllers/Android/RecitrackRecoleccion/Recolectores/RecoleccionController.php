<?php

namespace App\Http\Controllers\Android\RecitrackRecoleccion\Recolectores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recoleccion;
use App\Models\Negocio;
use App\Models\Planta;
use App\Models\Multa;
use App\Models\Pago;

class RecoleccionController extends Controller
{
   function CargarRecoleccion(Request $request){
       $recolecciones=PostmanAndroid($request);
       $correctos=array();
       //return $recolecciones[0]['created_at'];
       foreach($recolecciones as $recoleccion){
           //return Recoleccion::where('fechavisita',date('Y-m-d',strtotime($recoleccion['created_at'])))->first();
            if(Recoleccion::where('id_negocio',$recoleccion['id'])->whereraw("date(fechavisita) = '".date('Y-m-d',strtotime($recoleccion['created_at']))."'")->first()){
                $correctos[]=$recoleccion['id'];
            }else{
                $recol=new Recoleccion();
                $recol->id=GetUuid();
                $recol->id_recolector=$recoleccion['id_recolector'];
                $recol->id_negocio=$recoleccion['id'];
                $recol->negocio=$recoleccion['negocio'];
                $recol->fechavisita=$recoleccion['created_at'];
                if($recol->save()){
                    $correctos[]=$recoleccion['id'];
                    //return Multa::where('id_negocio',$recoleccion['id'])->whereraw("year(created_at)='".date('Y',strtotime($recoleccion['created_at']))."'")->whereraw("month(created_at)='".date('m',strtotime($recoleccion['created_at']))."'")->first();
                    if(!Pago::where('id_negocio',$recoleccion['id'])->whereraw("year(created_at)='".date('Y',strtotime($recoleccion['created_at']))."'")->whereraw("month(created_at)='".date('m',strtotime($recoleccion['created_at']))."'")->where('status',2)->first()
                    && !Multa::where('id_negocio',$recoleccion['id'])->whereraw("year(created_at)='".date('Y',strtotime($recoleccion['created_at']))."'")->whereraw("month(created_at)='".date('m',strtotime($recoleccion['created_at']))."'")->first()){
                        $negocio=Negocio::find($recoleccion['id']);
                        $planta=Planta::find($negocio->id_planta);                        
                        $multa=new Multa();
                        $multa->id=GetUuid();
                        $multa->id_planta=$planta->id;
                        $multa->id_negocio=$recoleccion['id'];
                        $multa->save();
                    }
                   
                }
            }
           
       }
       return $correctos;
   }
}
