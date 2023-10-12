<?php

namespace App\Http\Controllers\Android\RecitrackTransporte\Choferes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Coordenada;
use App\Models\Cita;
use App\Models\PagoChofer;
use App\Models\Chofer;
use App\Models\Solicitud;

class ViajesController extends Controller
{
    function HistorialViajes(Request $request){
        //return $request->id_chofer;
        $respuesta=array();
        $request=PostmanAndroid($request);
        
         
        //$in=implode("','",$in);
        $citas=PagoChofer::select('citas.planta','citas.obra','pagoschof.id','citas.cantidad','citas.unidades','citas.material'
        ,'pagoschof.created_at','pagoschof.cantidad','pagoschof.status','pagoschof.precio')
        ->join('citas','pagoschof.id_cita','=','citas.id')
        ->orderby('created_at','desc')
        ->where('citas.id_chofer',$request[0]['id_chofer'])
        ->offset($request[0]['offset'])->limit(15)
        ->get();
        foreach($citas as $cita){
            //Lo mando a fecha por que en aondroid  no acepta el formato que regresa FechaFormateada como un campo datetime
            $cita->fecha=FechaFormateadaTiempo($cita->created_at);
            $respuesta[]=$cita;
        }

        return $respuesta;
    }


    function GetTotal(Request $request){
       
        $request=PostmanAndroid($request);
        
         
        //$in=implode("','",$in);
       

        $citas=PagoChofer::select(DB::RAW(" ifnull(sum(pagoschof.cantidad* pagoschof.precio),0) as total"))
        ->where('id_chofer',$request[0]['id_chofer'])
        ->where('status',0)
        ->get();

        $citas[0]->total=number_format($citas[0]->total,2);
        return $citas;
        
    }

    function SolicitarPago(Request $request){
        $respuesta=array();
        $request=PostmanAndroid($request);

        $chofer = Chofer::find($request[0]['id_chofer']);
        if(($chofer->cuenta) == ''){
            return RespuestaAndroid(0,'No se puede solicitar pagos, primero registre su cuenta CLABE.',array());
        }

        
        $pagos=PagoChofer::select('id','cantidad','precio','id_planta')->where('status',0)->where('id_chofer',$request[0]['id_chofer'])->get();
        
        
        
        if(!count($pagos)){
            return RespuestaAndroid(1,'',$pagos);
        }
        
        $id_pagosa=array();
        $total=0;
        $id_planta='';
        foreach($pagos as $pago){
            $id_pagosa[]=$pago->id;
            $total += $pago->precio * $pago->cantidad;
            $id_planta=$pago->id_planta;
            unset($pago->precio);
            unset($pago->cantidad);
        }
        $id_pagos=implode(',',$id_pagosa);

        $solicitud=new Solicitud();

        $solicitud->id = GetUuid();        
        $solicitud->id_planta = $id_planta;
        $solicitud->id_chofer = $request[0]['id_chofer'];
        $solicitud->id_pagos = $id_pagos;
        $solicitud->monto = $total;

        $solicitud->save();

        DB::table('pagoschof')
            ->wherein('id', $id_pagosa)
            ->update(['status' => 1
        ]); 

        
        return RespuestaAndroid(1,'',$pagos);
        
         
    }

    function GetSolicitudes(Request $request){
        $respuesta=array();
        $request=PostmanAndroid($request);

        $solicitudes = Solicitud::select('monto','status',DB::RAW(" '' as fecha"),'created_at')
        ->where('id_chofer',$request[0]['id_chofer'])
        ->orderby('created_at','desc')
        ->offset($request[0]['offset'])->limit(15)
        ->get();

        foreach($solicitudes as $index=>$cita){
            //Lo mando a fecha por que en aondroid  no acepta el formato que regresa FechaFormateada como un campo datetime
            $solicitudes[$index]->fecha=FechaFormateadaTiempo($solicitudes[$index]->created_at);
            
        }

        return $solicitudes;
        


    }
}
