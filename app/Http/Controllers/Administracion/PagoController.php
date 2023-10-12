<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Pago;
use App\Models\Cliente;
use App\Models\Negocio;
use App\Models\Planta;
use Redirect;

class PagoController extends Controller
{


    public function __construct(){
        $this->middleware('administradorlogged');
    }

    
    public function index(Request $filtros)
    {
        
       

        $pagos=DB::table('pagos')
        ->join('obras','obras.id','=','pagos.id_obra')
        ->select('obras.obra','pagos.id','pagos.monto','pagos.descripcion','pagos.detalle','pagos.created_at',DB::raw('time(pagos.created_at) as hora'),'pagos.status','pagos.referencia')
        ->orderby('created_at','desc')
        ->where('obras.obra','like','%'.$filtros->obra.'%')
        ->where('pagos.id_planta','=',GetIdPlanta())
        ->paginate(15);
        return view('administracion.pagos.pagos',['pagos'=>$pagos,'filtros'=>$filtros]);
    }

   

    function CargarPagos(Request $request){

        //return $request;
        if(is_null($request->monto)){
            return Redirect::back()->with('error', 'El campo monto no puede ser nulo.');
        }
        if(is_null($request->negocio)){
            return Redirect::back()->with('error', 'El campo negocio no puede ser nulo.');
        }
        if(is_null($request->nombre)){
            return Redirect::back()->with('error', 'El campo nombre no puede ser nulo.');
        }
        if(is_null($request->direccion)){
            return Redirect::back()->with('error', 'El campo direccion no puede ser nulo.');
        }
        if(is_null($request->cp)){
            return Redirect::back()->with('error', 'El campo cp no puede ser nulo.');
        }
        if(is_null($request->municipio)){
            return Redirect::back()->with('error', 'El campo municipio no puede ser nulo.');
        }
        if(is_null($request->entidad)){
            return Redirect::back()->with('error', 'El campo entidad no puede ser nulo.');
        }
        $request->monto = str_replace(",","",$request->monto); 

        

        
        $negocio=Negocio::where('id',$request->negocio)->first();

        $planta=Planta::where('id','=',$negocio->id_planta)->first();
        
        $configuracion=DB::table('configuraciones')
        ->where('id_planta','=',$planta->id)
        ->first();

        $cliente=DB::table('clientes')
        ->join('generadores','generadores.id_cliente','=','clientes.id')
        ->select('clientes.id')
        ->where('generadores.id','=',$negocio->id_generador)
        ->first();

        
        $pago=new Pago();
        $id = $pago->id = GetUuid();
        $pago->id_cliente = $cliente->id;        
        $pago->id_obra = '';      
        $pago->id_negocio = $request->negocio;
        $pago->id_planta = $negocio->id_planta;
        $pago->monto = $request->monto;
        $pago->nombre = $request->nombre;
        $pago->direccion = $request->direccion;
        $pago->cp = $request->cp;
        $pago->municipio = $request->municipio;
        $pago->entidad = $request->entidad;
        $pago->descripcion = 'Transferencia';

        $number1 = Pago::count();
        $length = 4;
        $number1 = substr(str_repeat(0, $length).$number1, - $length);

        $number2 = rand(1,9999);
        $length = 4;
        $number2 = substr(str_repeat(0, $length).$number2, - $length);


        $pago->referencia= $configuracion->referencia.'-'.$number1.'-'.$number2;
        if($pago->save()){
            
            return Redirect::back()->with('success', 'Se generó el pago.')->with('transferencia', $id);
        }else{
            return Redirect::back()->with('error', 'Error al generar el pago.');
        }

       
    }

}
