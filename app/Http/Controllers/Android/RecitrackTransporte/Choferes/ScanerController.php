<?php

namespace App\Http\Controllers\Android\RecitrackTransporte\Choferes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Chofer;
use App\Models\Remision;
use Illuminate\Support\Facades\DB;

class ScanerController extends Controller
{
    function DataCita(Request $request){
        $respuesta=array();
        $request=PostmanAndroid($request);
        
        $cita =  DB::table('citas')
        ->join('obras','obras.id','=','citas.id_obra')
        ->join('plantas','plantas.id','=','obras.id_planta')
        ->select('citas.id','citas.obra','citas.material',DB::raw("concat(citas.cantidad,' ',citas.unidades) as cantidad"),
        'citas.planta',DB::raw('0 as tipo'),
        DB::RAW("((plantas.latitud+plantas.latitud2)/2) as latitud"),DB::RAW("((plantas.longitud+plantas.longitud2)/2) as longitud"))
        ->where('citas.id','=',$request[0]['id'])
        ->get();

        if(count($cita)>0){
            return $cita;
        }else{
            /*"id"
            "obra"
            "material"
            "cantidad"
            "planta"
            "latitud"
            "longitud"*/
            return $remicion = Remision::select('id','obra','pedidos as cantidad','planta',
            DB::raw('1 as tipo'),
            DB::RAW("(select producto from detallepedidos where id=remisiones.id_detallepedido ) as material"),
            DB::RAW("(select ((latitud+latitud2)/2) from plantas where id = (select id_planta from pedidos where id = (select id_pedido from detallepedidos where id = remisiones.id_detallepedido ))) as latitud"),
            DB::RAW("(select ((longitud+longitud2)/2) from plantas where id = (select id_planta from pedidos where id = (select id_pedido from detallepedidos where id = remisiones.id_detallepedido ))) as longitud")
            )
            ->where('id',$request[0]['id'])->get();
        }

        
    }

    function AceptarCita(Request $request){
         

        $citat = Cita::select('id','obra','material','matricula',
        DB::raw("concat(cantidad,' ',unidades) as cantidad"),
        DB::raw(" '' as id_empresatransporte"),'planta')
        ->where('id','=',$request->id)
        ->whereraw(" confirmacion = 0 and id_chofer='' ")
        ->first();

       

        if(!$citat){
            return json_encode(array('error'=>'Esta cita no esta disponible.'));
        }


        $vehiculo=DB::table('vehiculos')
        ->where('matricula',$citat->matricula)
        ->select('id_empresatransporte')
        ->first();

        $citat->id_empresatransporte=$vehiculo->id_empresatransporte;

        $chofer=Chofer::find($request->id_chofer);
        
        
        if(!$chofer){
            return json_encode(array('error'=>'No se encuentra el chofer.'));
        }
        

        $cita = Cita::find($citat->id);
        $cita->id_chofer=$request->id_chofer;
        $cita->firmachof = $request->firmachof;
        
        $cita->nombrecompleto = $chofer->nombres." ".$chofer->apellidos;
        
        $cita->telefonovehiculo=$chofer->telefono;
        if($cita->confirmacion==0){
            $cita->confirmacion = 3;
        }
        if($cita->save()){
           
            return ($citat);
        }else{
            return json_encode(array('error'=>'Error al guardar'));
        }
            
    }

   
}
