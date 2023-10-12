<?php

namespace App\Http\Controllers\Vendedor;

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
        $this->middleware('vendedorlogged');
    }

    
    public function index(Request $filtros)
    {
        
       

        $pagos=DB::table('pagos')
        ->join('obras','obras.id','=','pagos.id_obra')
        ->select('obras.obra','pagos.id','pagos.monto','pagos.descripcion','pagos.detalle','pagos.created_at',
        DB::RAW("(SELECT razonsocial from generadores where id=obras.id_generador ) as generador"),
        DB::raw('time(pagos.created_at) as hora'),'pagos.status','pagos.referencia')
        ->orderby('created_at','desc')
        ->where('obras.obra','like','%'.$filtros->obra.'%')
        ->where('pagos.id_planta','=',Auth::guard('vendedores')->user()->id_planta)
        ->paginate(15);
        return view('ventas.pagosvalidacion.pagos',['pagos'=>$pagos,'filtros'=>$filtros]);
    }

    function VerificarPago($id)
    {
        if(VerificarPago($id)){  
            return Redirect::back()->with('success', 'Pago verificado.');
        }else{
            return Redirect::back()->with('warning', 'Error al verificar el pago.');
        }

        
    }

    function show($id){
        $pago=Pago::find($id);
        return view('ventas.pagosvalidacion.pago',['pago'=>$pago]);
    }

    function update(Request $request,$id){
        $pago=Pago::find($id);
        $montoini=$pago->monto;
        $montofin=$request->monto;
        $pago->monto=$request->monto;
        if($pago->save()){
            Historial('Pagos',$id,GetId(),'Edicion de motos en pago.','Se modifico el monto de '.$montoini.' a '.$montofin);
            return Redirect::back()->with('success', 'Pago modificado.');
        }else{
            return Redirect::back()->with('error', 'Error al modificar.');
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
