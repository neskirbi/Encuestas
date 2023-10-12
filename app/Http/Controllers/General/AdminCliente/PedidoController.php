<?php

namespace App\Http\Controllers\General\AdminCliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Obra;
use App\Models\Residente;
use App\Models\Remision;
use App\Models\Vehiculo;
use App\Models\DetallePedido;
use App\Models\Codigo;
use App\Models\Planta;
use App\Models\Configuracion;
use Illuminate\Support\Facades\DB;
use Auth;
use Redirect;

class PedidoController extends Controller
{        

    
   


    function GenerarRemision(Request $request,$id){

       // return $request;
        if(isset($request->vehiculo)){
            $matricula = $request->vehiculo;
        }
        if(isset($request->matricula)){
            $matricula = $request->matricula;
        }
        
        $vehiculo=Vehiculo::where('id',$matricula)->first();
        
        $producto = DetallePedido::join('pedidos','pedidos.id','=','detallepedidos.id_pedido')
        ->select('detallepedidos.id','detallepedidos.cantidad','detallepedidos.id_obra','pedidos.id_vendedor',
        DB::raw("detallepedidos.cantidad - (SELECT if(count(id)=0,0,sum(pedidos)) from remisiones where id_detallepedido = detallepedidos.id) as restantes"),
        DB::raw("(SELECT if(count(id)=0,0,sum(pedidos)) from remisiones where id_detallepedido = detallepedidos.id) as consumo"),
        DB::raw("(SELECT count(id) from remisiones where id_detallepedido = detallepedidos.id) as orden"),
        DB::raw("(SELECT id_planta from pedidos where id=detallepedidos.id_pedido) as id_planta"),        
        DB::raw("(SELECT planta from plantas where id=(select id_planta from pedidos where id=detallepedidos.id_pedido)) as planta"),
        DB::raw("(select obra from obras where id=detallepedidos.id_obra) as obra"),
        DB::raw("(select concat(obras.calle,' ',obras.numeroext,' ',obras.numeroint,' Col.',obras.colonia,' CP.',obras.cp,' ',obras.municipio,' ',obras.entidad) from obras where id=detallepedidos.id_obra)  as obra_domicilio"))
        ->where('detallepedidos.id',$id)->first();

        $configuracion = Configuracion::select('referencia')->where('id_planta',$producto->id_planta)->first();

        $planta = Planta::select(DB::RAW("((plantas.latitud+plantas.latitud2)/2) as latitud"),
        DB::RAW("((plantas.longitud+plantas.longitud2)/2) as longitud"))->where('id',$producto->id_planta)->first();

        if($producto->restantes==0 || $producto->restantes-$request->cantidad<0){
            return Redirect::back()->with('error','No hay producto disponible por enviar.');
        }
        $residente=Residente::join('residentesobras','residentesobras.id_residente','=','residentes.id')
        ->join('obras','residentesobras.id_obra','=','obras.id')
        ->select(DB::RAW("group_concat(residentes.nombre separator'<br>') as residente"),
        DB::RAW("group_concat(obras.telefono separator'<br>') as residente_telefono"))
        ->where('id_obra',$producto->id_obra)->groupby('residentesobras.id_obra')->first();

        $remision= new Remision();
        $remision->id=GetUuid();
        $remision->id_detallepedido=$id;
        $remision->id_vendedor=$producto->id_vendedor;
        $remision->orden=$producto->orden+1;
        $remision->restantes=$producto->restantes;
        $remision->pedidos=$request->cantidad;
        $remision->entregados=$producto->consumo+$request->cantidad;
        
        $remision->planta=$producto->planta;
        $remision->planta_salida=GetDateTimeNow();
        $remision->planta_entrada=GetDateTimeNow();
        $remision->obra_entrada=GetDateTimeNow();
        $remision->obra_descarga=GetDateTimeNow();
        $remision->obra_salida=GetDateTimeNow();

        $remision->matricula=$vehiculo->matricula;

        $remision->latitud=$planta->latitud;

        $remision->longitud=$planta->longitud;



        $remision->obra=$producto->obra;
        $remision->obra_domicilio=$producto->obra_domicilio;

        $remision->residente=isset($residente->residente) ? $residente->residente : '';
        $remision->residente_telefono=isset($residente->residente_telefono) ? $residente->residente_telefono : '';


        $number1 = Remision::count();
        $length = 4;
        $number1 = substr(str_repeat(0, $length).$number1, - $length);

        $number2 = rand(1,9999);
        $length = 4;
        $number2 = substr(str_repeat(0, $length).$number2, - $length);


        $remision->referencia = $configuracion->referencia.'-'.$number1.'-'.$number2;

        $remision->save();
        return Redirect::back()->with('success','Remisión se generó.');


    }


    

    

   
}
