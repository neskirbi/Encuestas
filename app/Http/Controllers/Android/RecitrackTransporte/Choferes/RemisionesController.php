<?php

namespace App\Http\Controllers\Android\RecitrackTransporte\Choferes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Chofer;
use App\Models\Remision;

class RemisionesController extends Controller
{
    


    function Viajes(Request $request){
        //return $request;
        //return $request->id_chofer;
        $respuesta=array();
        $request=PostmanAndroid($request);
        $chofer=Chofer::find($request[0]['id_chofer']);
        
        $remisiones=DB::table('pedidos')->join('detallepedidos','detallepedidos.id_pedido','=','pedidos.id')
        ->join('remisiones','remisiones.id_detallepedido','=','detallepedidos.id')
        ->select('remisiones.id','remisiones.obra','remisiones.pedidos','remisiones.obra_domicilio','remisiones.created_at',db::raw("'' as fecha" )       ,
        db::raw("(select unidades from detallepedidos where id=remisiones.id_detallepedido) as unidades "),
        db::raw("(select producto from detallepedidos where id=remisiones.id_detallepedido) as producto "),
        db::raw("(select descripcion from detallepedidos where id=remisiones.id_detallepedido) as descripcion "),
        db::raw("(select latitud from obras where id= (select id_obra from detallepedidos where id=remisiones.id_detallepedido )) as latitud "),
        db::raw("(select longitud from obras where id= (select id_obra from detallepedidos where id=remisiones.id_detallepedido )) as longitud "))
        ->orderby('remisiones.created_at','desc')->where('remisiones.confirmacion',1)->where('pedidos.id_planta',$chofer->id_planta)->get();
        for($i=0;$i<count($remisiones);$i++){
            //$remisiones[$i]->fecha=FechaFormateada($remisiones[$i]->created_at);
        }

        return $remisiones;
    }



    function AceptarViaje(Request $request){
        $viajes=PostmanAndroid($request);
        $respuesta=array();

        foreach($viajes as $viaje){
            $chofer=Chofer::find($viaje['id_chofer']);
            $remision=Remision::where('id_chofer',$viaje['id_chofer'])->where('confirmacion','=',3)->first();
            if($remision){
                $respuesta[]=array('status'=>false,'msn'=>'No puedes hacer un viaje hasta que termines tu otro viaje.');
                //Es para controlar que no tengan viajes sin entregar pero como salen csm XD
                //return $respuesta;
            }
            $remision=Remision::where('confirmacion',1)->where('id',$viaje['id'])->first();
            if($remision){
                Orden1Cliente($viaje['id']);
                $remision->id_chofer=$viaje['id_chofer'];
                
                $remision->chofer=$chofer->nombres.' '.$chofer->apellidos;
                $remision->confirmacion=3;
                $remision->save();

                $remision=Remision::select('id','id_chofer','obra','pedidos','obra_domicilio','created_at',db::raw("'' as fecha" )       ,
                db::raw("(select unidades from detallepedidos where id=remisiones.id_detallepedido) as unidades "),
                db::raw("(select concat(producto,' ',descripcion,' ',pedidos,unidades) from detallepedidos where id=remisiones.id_detallepedido) as producto "),
                db::raw("(select descripcion from detallepedidos where id=remisiones.id_detallepedido) as descripcion "),
                db::raw("(select latitud from obras where id= (select id_obra from detallepedidos where id=remisiones.id_detallepedido )) as latitud "),
                db::raw("(select longitud from obras where id= (select id_obra from detallepedidos where id=remisiones.id_detallepedido )) as longitud "))
                ->where('id',$remision->id)->first();
                $respuesta[]=array('status'=>true,'remision'=>$remision);
                return $respuesta;
            }else{
                $respuesta[]=array('status'=>false,'msn'=>'El viaje no esta disponible.');
                return $respuesta;
            }
        }
        
      
    }

    function EntregarViajeFirma($id,$entrada,$descarga){
        $remision=Remision::find($id);
        return view('android.remisiones.entregarviaje',['remision'=>$remision,'entrada'=>$entrada,'descarga'=>$descarga]);
    }

    function EntregarViaje(Request $request,$id){
        //return $request;
        $remision=Remision::find($id);
        $remision->nombrerecibio=$request->nombrerecibio;
        $remision->firmares=$request->firmarecibio;
        $remision->obra_entrada=$request->entrada;
        $remision->obra_descarga=$request->descarga;
        
        $remision->obra_salida=GetDateTimeNow();
        
        $remision->confirmacion=2;
        $remision->save();
        if(ViajeEntregado($id)){
            Orden1Cliente($id);
            return view('android.remisiones.espera');
        }else{
            return "Error";
        }
       
    }
}
