<?php

namespace App\Http\Controllers\Finanzas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Pago;
use App\Models\Cliente;
use Redirect;

class PagoValidacionController extends Controller
{

    public function __construct(){
        $this->middleware('finanzaslogged');
    }

    
    
    public function index()
    {
        $pago=DB::table('pagos')
        ->where('id_planta','=',GetIdPlanta())
        ->where('status','=',2)
        ->select(DB::raw('sum(monto) as montot'))
        ->first();

        $pagos_fecha=DB::table('pagos')
        ->where('id_planta','=',GetIdPlanta())
        ->where('status','=',2)
        ->select(DB::raw('date(created_at) as created_at'),DB::raw('sum(monto) as montot'))
        ->groupby('created_at')
        ->get();

        /**
         * Aqui se calcula mas iva por que no tiene iva contamplado
         */
        $citas=DB::table('citas')
        ->select(DB::raw('sum((citas.cantidad*citas.precio)+(citas.cantidad*citas.precio*(citas.iva/100))) as consumo'))
        ->where('citas.id_planta','=',GetIdPlanta())
        ->where('citas.confirmacion',1)
        ->first();

        /**
         * Aqui solo se calcula la suma de la columna total, porque ya viene el iva
         */
        $pedidos = DB::table('pedidos')  
        ->where('id_planta',GetIdPlanta())
        ->where('confirmacion','=',2)
        ->select( DB::raw('SUM((total)) as monto'))
        ->first();

        $consumo=$citas->consumo+$pedidos->monto;
        

        $clientegastos=DB::table('obras')
        ->leftjoin('citas',function($join){
            $join->on('citas.id_obra','=','obras.id');
            $join->on('citas.confirmacion','=',DB::raw('1'));
        })
        ->select(
        DB::raw("obras.obra as nombre"),
        DB::raw('sum((citas.cantidad*citas.precio)+(citas.cantidad*citas.precio*(citas.iva/100))) as reciclaje'),
        DB::raw("(select sum(total) from pedidos where id_obra =obras.id  and confirmacion=2) as pedidos"),
        DB::raw("(SELECT sum(monto) from pagos where status=2 and id_obra=obras.id  ) as pagos"))
        ->groupby('obras.id','obras.obra')
        ->orderby('nombre', 'asc')
        ->where('obras.id_planta','=',GetIdPlanta())
        ->get();

       

        $pagos=DB::table('pagos')
        ->join('obras','obras.id','=','pagos.id_obra')
        ->select('obras.obra','pagos.id','pagos.monto','pagos.descripcion','pagos.detalle','pagos.created_at',DB::raw('time(pagos.created_at) as hora'),'pagos.status','pagos.referencia')
        ->orderby('created_at','desc')
        ->where('pagos.id_planta','=',GetIdPlanta())
        ->paginate(15);
        return view('finanzas.pagosvalidacion.pagos',['pago'=>$pago,'pagos'=>$pagos,'consumo'=>$consumo,'pagos_fecha'=>$pagos_fecha,'clientegastos'=>$clientegastos]);
    }

    function VerificarPago($id)
    {
        if(VerificarPago($id)){  
            return Redirect::back()->with('success', 'Pago verificado.');
        }else{
            return Redirect::back()->with('warning', 'Error al verificar el pago.');
        }

        
    }

    function CancelarPago(Request $request, $id)
    {        
        if(CancelarPago($request, $id)){
            return Redirect::back()->with('error', 'Pago cancelado.');
        }else{
            return Redirect::back()->with('warning', 'Error al cancelar el pago.');
        }
        
    }

}
