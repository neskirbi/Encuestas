<?php

namespace App\Http\Controllers\Dosificadores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrackingController extends Controller
{
    //

    function Tracking(){
        $remisiones=DB::table('clientes')
        ->select('remisiones.id','remisiones.obra','remisiones.obra_domicilio','remisiones.confirmacion',
        DB::RAW("(select concat(producto,' ',remisiones.pedidos,' ',unidades) as descripcion from detallepedidos where id = remisiones.id_detallepedido) as descripcion "))
        ->join('generadores','generadores.id_cliente','=','clientes.id')
        ->join('obras','obras.id_generador','=','generadores.id')            
        ->join('pedidos','pedidos.id_obra','=','obras.id')           
        ->join('detallepedidos','detallepedidos.id_pedido','=','pedidos.id')
        ->join('remisiones','remisiones.id_detallepedido','=','detallepedidos.id')
        ->whereraw("(remisiones.confirmacion = 3  ) and (obras.id_planta ='".GetIdPlanta()."') ")
        ->get();

      


        return view('dosificadores.tracking.tracking',['remisiones'=>$remisiones]);
    }
}
