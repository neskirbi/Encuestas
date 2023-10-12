<?php

namespace App\Http\Controllers\Android\Recitrack;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Remision;
use Illuminate\Support\Facades\DB;
class RemisionController extends Controller
{
    function Remisiones(Request $request){
        
        $clientes=PostmanAndroid($request);
        foreach($clientes as $cliente){
            $remisiones=DB::table('clientes')
            ->select('remisiones.id','remisiones.obra','remisiones.obra_domicilio','remisiones.confirmacion',DB::RAW("(select concat(producto,' ',remisiones.pedidos,' ',unidades) as descripcion from detallepedidos where id = remisiones.id_detallepedido) as descripcion "))
            ->join('generadores','generadores.id_cliente','=','clientes.id')
            ->join('obras','obras.id_generador','=','generadores.id')            
            ->join('pedidos','pedidos.id_obra','=','obras.id')           
            ->join('detallepedidos','detallepedidos.id_pedido','=','pedidos.id')
            ->join('remisiones','remisiones.id_detallepedido','=','detallepedidos.id')
            ->whereraw("(remisiones.confirmacion = 3 or remisiones.confirmacion = 1 ) and (clientes.id ='".$cliente['id']."' or obras.id in (select id_obra from residentesobras where id_residente='".$cliente['id']."')) ")
            ->get();

            return RespuestaAndroid(1,'',$remisiones);

        }
    }

    function GetObras(Request $request){
        
        $clientes=PostmanAndroid($request);
        foreach($clientes as $cliente){
            $obras=DB::table('clientes')
            ->select('obras.id','obras.obra','obras.latitud','obras.longitud',
            DB::raw("( concat(obras.calle,' ',obras.numeroext,' ',obras.numeroint,' Col.',obras.colonia,' CP.',obras.cp,' ',obras.municipio,' ',obras.entidad) )  as obra_domicilio"))
            ->join('generadores','generadores.id_cliente','=','clientes.id')
            ->join('obras','obras.id_generador','=','generadores.id')              
            ->whereraw(" (clientes.id ='".$cliente['id']."' or obras.id in (select id_obra from residentesobras where id_residente='".$cliente['id']."')) ")
            ->get();

            return RespuestaAndroid(1,'',$obras);

        }
    }
}
