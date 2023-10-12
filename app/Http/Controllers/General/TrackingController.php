<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrackingController extends Controller
{
    //

    function Tracking(){
        $remisiones=DB::table('clientes')
        ->select('remisiones.id','remisiones.obra','remisiones.obra_domicilio','remisiones.confirmacion',DB::RAW("(select concat(producto,' ',remisiones.pedidos,' ',unidades) as descripcion from detallepedidos where id = remisiones.id_detallepedido) as descripcion "))
        ->join('generadores','generadores.id_cliente','=','clientes.id')
        ->join('obras','obras.id_generador','=','generadores.id')            
        ->join('pedidos','pedidos.id_obra','=','obras.id')           
        ->join('detallepedidos','detallepedidos.id_pedido','=','pedidos.id')
        ->join('remisiones','remisiones.id_detallepedido','=','detallepedidos.id')
        ->whereraw("(remisiones.confirmacion = 3 or remisiones.confirmacion = 1 ) and (clientes.id ='".GetIdCliente()."' or obras.id in (select id_obra from residentesobras where id_residente='".GetIdCliente()."')) ")
        ->get();

        $obras=DB::table('clientes')
        ->select('obras.id',DB::raw('replace(obras.obra,\'"\',\'\') as obra'),'obras.latitud','obras.longitud')
        ->join('generadores','generadores.id_cliente','=','clientes.id')
        ->join('obras','obras.id_generador','=','generadores.id')              
        ->whereraw(" (clientes.id ='".GetIdCliente()."' or obras.id in (select id_obra from residentesobras where id_residente='".GetIdCliente()."')) ")
        ->get();


        return view('generales.tracking.tracking',['remisiones'=>$remisiones,'obras'=>$obras]);
    }
}
